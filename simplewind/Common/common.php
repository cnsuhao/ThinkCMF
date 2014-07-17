<?php
function sp_get_host(){
	return (is_ssl()?"https://":"http://").$_SERVER['HTTP_HOST'];
}

function get_current_admin_id(){
	return $_SESSION['ADMIN_ID'];
}

function get_current_userid(){
	return $_SESSION['MEMBER_id'];
}
function sp_password($pw){
	$decor=md5(C('DB_PREFIX'));
	$mi=md5($pw);
	return substr($decor,0,12).$mi.substr($decor,-4,4);
}

function sp_log($content,$file="log.txt"){
	file_put_contents($file, $content,FILE_APPEND);
}

function sp_random_string($len = 6) {
	$chars = array(
			"a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k",
			"l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v",
			"w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G",
			"H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R",
			"S", "T", "U", "V", "W", "X", "Y", "Z", "0", "1", "2",
			"3", "4", "5", "6", "7", "8", "9"
	);
	$charsLen = count($chars) - 1;
	shuffle($chars);    // 将数组打乱
	$output = "";
	for ($i = 0; $i < $len; $i++) {
		$output .= $chars[mt_rand(0, $charsLen)];
	}
	return $output;
}

/**
 * 清空缓存
 */
function sp_clear_cache(){
		import ( "ORG.Util.Dir" );
		$dirs = array ();
		// runtime/
		$rootdirs = scandir ( RUNTIME_PATH );
		//$noneed_clear=array(".","..","Data");
		$noneed_clear=array(".","..");
		$rootdirs=array_diff($rootdirs, $noneed_clear);
		foreach ( $rootdirs as $dir ) {
			
			if ($dir != "." && $dir != "..") {
				$dir = RUNTIME_PATH . $dir;
				if (is_dir ( $dir )) {
					array_push ( $dirs, $dir );
					$tmprootdirs = scandir ( $dir );
					foreach ( $tmprootdirs as $tdir ) {
						if ($tdir != "." && $tdir != "..") {
							$tdir = $dir . '/' . $tdir;
							if (is_dir ( $tdir )) {
								array_push ( $dirs, $tdir );
							}
						}
					}
				}else{
					@unlink($dir);
				}
			}
		}
		$dirtool=new Dir("");
		foreach ( $dirs as $dir ) {
			$dirtool->del ( $dir );
		}
		
		if(defined('IS_SAE') && IS_SAE){
			$global_mc=@memcache_init();
			if($global_mc){
				$global_mc->flush();
			}
			
			$no_need_delete=array("THINKCMF_DYNAMIC_CONFIG");
			$kv = new SaeKV();
			// 初始化KVClient对象
			$ret = $kv->init();
			// 循环获取所有key-values
			$ret = $kv->pkrget('', 100);
			while (true) {
				foreach($ret as $key =>$value){
                    if(!in_array($key, $no_need_delete)){
                    	$kv->delete($key);
                    }
                }
				end($ret);
				$start_key = key($ret);
				$i = count($ret);
				if ($i < 100) break;
				$ret = $kv->pkrget('', 100, $start_key);
			}
			
		}
	
}

/**
 * 保存变量
 */
function sp_save_var($path,$value){
	$ret = file_put_contents($path, "<?php\treturn " . var_export($value, true) . ";?>");
	return $ret;
}

function sp_set_dynamic_config($data){
	if(defined('IS_SAE') && IS_SAE){
		$kv = new SaeKV();
		$ret = $kv->init();
		$configs=$kv->get("THINKCMF_DYNAMIC_CONFIG");
		$configs=empty($configs)?array():unserialize($configs);
		$configs=array_merge($configs,$data);
		$result = $kv->set('THINKCMF_DYNAMIC_CONFIG', serialize($configs));
	}elseif(defined('IS_BAE') && IS_BAE){
		$bae_mc=new BaeMemcache();
		$configs=$bae_mc->get("THINKCMF_DYNAMIC_CONFIG");
		$configs=empty($configs)?array():unserialize($configs);
		$configs=array_merge($configs,$data);
		$result = $bae_mc->set("THINKCMF_DYNAMIC_CONFIG",serialize($configs),MEMCACHE_COMPRESSED,0);
	}else{
		$config_file="./data/conf/config.php";
		if(file_exists($config_file)){
			$configs=include $config_file;
		}else {
			$configs=array();
		}
		$configs=array_merge($configs,$data);
		$result = file_put_contents($config_file, "<?php\treturn " . var_export($configs, true) . ";?>");
	}
	sp_clear_cache();
	return $result;
}


/**
 * 生成参数列表,以数组形式返回
 */
function sp_param_lable($tag = ''){
	$param = array();
	$array = explode(';',$tag);
	foreach ($array as $v){
		list($key,$val) = explode(':',trim($v));
		$param[trim($key)] = trim($val);
	}
	return $param;
}


/**
 * 
 */

function get_site_options(){
	$site_options = F("site_options");
	if(empty($site_options)){
		$options_obj = M("Options");
		$option = $options_obj->where("option_name='site_options'")->find();
		if($option){
			$site_options = (array)json_decode($option['option_value']);
		}else{
			$site_options = array();
		}
		F("site_options", $site_options);
	}
	return $site_options;	
}




/**
 * 全局获取验证码图片
 * 生成的是个HTML的img标签
 * @param string $imgparam 
 * 生成图片样式，可以设置
 * code_len=4&font_size=20&width=238&height=50&font_color=#ffffff&background=#000000
 * code_len:字符长度
 * font_size:字体大小
 * width:生成图片宽度
 * heigh:生成图片高度
 * font_color:字体颜色
 * background:图片背景
 * @param string $imgattrs
 * img标签原生属性，除src,onclick之外都可以设置
 * 默认值：style="cursor: pointer;" title="点击获取"
 * @return string
 * 原生html的img标签
 * 注，此函数仅生成img标签，应该配合在表单加入name=verify的input标签
 * 如：<input type="text" name="verify"/>
 */
function sp_verifycode_img($imgparam='code_len=4&font_size=20&width=238&height=50&font_color=&background=',$imgattrs='style="cursor: pointer;" title="点击获取"'){
	$src=U('Api/Checkcode/index',$imgparam);
	$img=<<<hello
<img  src="$src" onclick="this.src='$src&time='+Math.random();" $imgattrs/>
hello;
	return $img;
}




/**
 * 10
 * 返回指定id的菜单
 * 同上一类方法，jquery treeview 风格，可伸缩样式
 * @param $myid 表示获得这个ID下的所有子级
 * @param $effected_id 需要生成treeview目录数的id
 * @param $str 末级样式
 * @param $str2 目录级别样式
 * @param $showlevel 直接显示层级数，其余为异步显示，0为全部限制
 * @param $ul_class 内部ul样式 默认空  可增加其他样式如'sub-menu'
 * @param $li_class 内部li样式 默认空  可增加其他样式如'menu-item'
 * @param $style 目录样式 默认 filetree 可增加其他样式如'filetree treeview-famfamfam'
 * @param $dropdown 有子元素时li的class
 * $id="main";
 $effected_id="mainmenu";
 $filetpl="<a href='\$href'><span class='file'>\$label</span></a>";
 $foldertpl="<span class='folder'>\$label</span>";
 $ul_class="" ;
 $li_class="" ;
 $style="filetree";
 $showlevel=6;
 sp_get_menu($id,$effected_id,$filetpl,$foldertpl,$ul_class,$li_class,$style,$showlevel);
 * such as
 * <ul id="example" class="filetree ">
 <li class="hasChildren" id='1'>
 <span class='folder'>test</span>
 <ul>
 <li class="hasChildren" id='4'>
 <span class='folder'>caidan2</span>
 <ul>
 <li class="hasChildren" id='5'>
 <span class='folder'>sss</span>
 <ul>
 <li id='3'><span class='folder'>test2</span></li>
 </ul>
 </li>
 </ul>
 </li>
 </ul>
 </li>
 <li class="hasChildren" id='6'><span class='file'>ss</span></li>
 </ul>
 */

function sp_get_menu($id="main",$effected_id="mainmenu",$filetpl="<span class='file'>\$label</span>",$foldertpl="<span class='folder'>\$label</span>",$ul_class="" ,$li_class="" ,$style="filetree",$showlevel=6,$dropdown='hasChild'){
	$navs=F("site_nav_".$id);
	if(empty($navs)){
		$navs=_sp_get_menu_datas($id);
	}
	
	import("Tree");
	$tree = new Tree();
	$tree->init($navs);
	return $tree->get_treeview_menu(0,$effected_id, $filetpl, $foldertpl,  $showlevel,$ul_class,$li_class,  $style,  1, FALSE, $dropdown);
}
function _sp_get_menu_datas($id){
	$nav_obj= M("Nav");
	if($id=="main"){
		$navcat_obj= M("NavCat");
		$main=$navcat_obj->where("active=1")->find();
		$id=$main['navcid'];
	}
	$navs= $nav_obj->where("cid=$id and status=1")->order(array("listorder" => "ASC"))->select();
	foreach ($navs as $key=>$nav){
		$href=$nav['href'];
		$hrefold=$href;
		$href=unserialize(stripslashes($nav['href']));
		if(empty($href)){
			if($hrefold=="home"){
				$href=__ROOT__."/";
			}else{
				$href=$hrefold;
			}
		}else{
			$default_app=strtolower(C("DEFAULT_GROUP"));
			$href=U($href['action'],$href['param']);
			$g=C("VAR_GROUP");
			$href=preg_replace("/\/$default_app\//", "/",$href);
			$href=preg_replace("/$g=$default_app&/", "",$href);
		}
		$nav['href']=$href;
		$navs[$key]=$nav;
	}
	F("site_nav",$navs);
	return $navs;
}
function sp_get_menu_tree($id="main"){
	$navs=F("site_nav_".$id);
	if(empty($navs)){
		$navs=_sp_get_menu_datas($id);
	}

	import("Tree");
	$tree = new Tree();
	$tree->init($navs);
	return $tree->get_tree_array(0, "");
}



/**
 * 11
 * @param string $content
 * @return array
 */
function sp_getcontent_imgs($content){
	import("phpQuery");
	phpQuery::newDocumentHTML($content);
	$pq=pq();
	$imgs=$pq->find("img");
	$imgs_data=array();
	if($imgs->length()){
		foreach ($imgs as $img){
			$img=pq($img);
			$im['src']=$img->attr("src");
			$im['title']=$img->attr("title");
			$im['alt']=$img->attr("alt");
			$imgs_data[]=$im;
		}
	}
	phpQuery::$documents=null;
	return $imgs_data;
}

/*
 * 作用：写入新消息
 * 参数：$from	发送者id
 * 		$to		消息接受者id
 * 		$content  消息内容
 * 		$targetid 相应数据表中的id的值
 * 		$mestype可选值：topic_comment(话题评论)、topic_answer(话题回复)、topic_collect(话题收藏)、topic_love(喜欢)
 */
function insertMes($from, $to, $content, $targetid, $mestype){
	$data = array(
			'mes_from'	=> $from,
			'mes_to'	=> $to,
			'mes_content' => $content,
			'post_time'	=> time(),
			'target_id'	=> $targetid,
			'mes_type'	=> $mestype,
			'mes_status'=> '2', //未读
	);
	return M('Message')->add($data);
}

/*
 * 作用：查看用户消息
 * 参数：$uid	查询用户id
 * 		$status		消息接受者id
 * 		$mestype可选值：topic_comment(话题评论)、topic_answer(话题回复)、topic_collect(话题收藏)、topic_love(喜欢)
 * 注意：查询时仅限于members,message,topic三张表，因此只能查询三张表中的信息
 */
function getMes($uid, $type, $status=2){
	$DbPre = C('DB_PREFIX');
	$topic_comment = M()->query('select a.*,b.user_login_name,b.ID,c.topic_id,c.topic_cid,c.title
    								from '.$DbPre.'message a
    								left join '.$DbPre.'members b
    								on a.mes_from=b.ID
    								left join '.$DbPre.'topic c
    								on a.target_id=c.topic_id
    								where a.mes_status='.$status.' and mes_type=\''.$type.'\' and a.mes_to='.$uid
									.' order by a.post_time desc');
	return $topic_comment;
}

//获取站内消息数量
function getMesNum(){
	if(!isset($_SESSION["MEMBER_id"])) return;
	return M('Message')->where('mes_status=2 and mes_to='.$_SESSION["MEMBER_id"])->count();
}
/**
 * 
 * @param unknown_type $navcatname
 * @param unknown_type $datas
 * @param unknown_type $navrule
 * @return string
 */
function sp_get_nav4admin($navcatname,$datas,$navrule){
	$nav['name']=$navcatname;
	$nav['urlrule']=$navrule;
	foreach($datas as $t){
		$urlrule=array();
		$group=strtolower(GROUP_NAME)==strtolower(C("DEFAULT_GROUP"))?"":GROUP_NAME."/";
		$action=$group.$navrule['action'];
		$urlrule['action']=GROUP_NAME."/".$navrule['action'];
		$urlrule['param']=array();
		if(isset($navrule['param'])){
			foreach ($navrule['param'] as $key=>$val){
				$urlrule['param'][$key]=$t[$val];
			}
		}
		
		$nav['items'][]=array(
				"label"=>$t[$navrule['label']],
				"url"=>U($action,$urlrule['param']),
				"rule"=>serialize($urlrule)
		);
	}
	return json_encode($nav);
}

function sp_get_apphome_tpl($tplname,$default_tplname,$default_theme=""){
	$theme      =    C('SP_DEFAULT_THEME');
	if(C('TMPL_DETECT_THEME')){// 自动侦测模板主题
		$t = C('VAR_TEMPLATE');
		if (isset($_GET[$t])){
			$theme = $_GET[$t];
		}elseif(cookie('think_template')){
			$theme = cookie('think_template');
		}
	}
	$theme=empty($default_theme)?$theme:$default_theme;
	$themepath=C("SP_TMPL_PATH").$theme."/".GROUP_NAME."/";
	$tplpath=$themepath.$tplname.C("TMPL_TEMPLATE_SUFFIX");
	$defaultpl=$themepath.$default_tplname.C("TMPL_TEMPLATE_SUFFIX");
	if(file_exists($tplpath)){
	}else if(file_exists($defaultpl)){
		$tplname=$default_tplname;
	}else{
		$tplname="404";
	}
	return $tplname;
}

//面包屑导航
function sp_bread_nav($nav_id){
	$navTable = M('Nav');
	$path = $navTable->where("id=$nav_id")->getField('path');
	if(!$path) return array();
	$path = str_replace('-',',',$path);
	$bread_path = $navTable->where("id in ($path)")->order('id')->select();
	return $bread_path;
}

/*
 * 作用：去除字符串中的指定字符
 * 参数: $str, string, 待处理字符串
 *       $chars, string, 需去掉的特殊字符
 */
function sp_strip_chars($str, $chars='?<*.>\'\"'){
	return preg_replace('/['.$chars.']/is', '', $str);
}

//发送邮件
function SendMail($address,$title,$message){
	import("PHPMailer");
	$mail=new PHPMailer();
	// 设置PHPMailer使用SMTP服务器发送Email
	$mail->IsSMTP();
	$mail->IsHTML(true);
	// 设置邮件的字符编码，若不指定，则为'UTF-8'
	$mail->CharSet='UTF-8';
	// 添加收件人地址，可以多次使用来添加多个收件人
	$mail->AddAddress($address);
	// 设置邮件正文
	$mail->Body=$message;
	// 设置邮件头的From字段。
	$mail->From=C('SP_MAIL_ADDRESS');
	// 设置发件人名字
	$mail->FromName='ThinkCMF';
	// 设置邮件标题
	$mail->Subject=$title;
	// 设置SMTP服务器。
	$mail->Host=C('SP_MAIL_SMTP');
	// 设置为"需要验证"
	$mail->SMTPAuth=true;
	// 设置用户名和密码。
	$mail->Username=C('SP_MAIL_LOGINNAME');
	$mail->Password=C('SP_MAIL_PASSWORD');
	// 发送邮件。
	return($mail->Send());
}

function sp_get_asset_upload_path($file,$withhost=false){
	if(strpos($file,"http")===0){
		return $file;
	}else{
		$filepath=C("TMPL_PARSE_STRING.__UPLOAD__").$file;
		if($withhost){
			if(strpos($filepath,"http")!==0){
				$http = 'http://';
				$http =is_ssl()?'https://':$http;
				$filepath = $http.$_SERVER['HTTP_HOST'].$filepath;
			}
		}
		return $filepath;
		
	}                    			
                        		
}


function sp_authcode($string, $operation = 'DECODE', $key = '', $expiry = 0) {
	$ckey_length = 4;

	$key = md5($key ? $key : C("AUTHCODE"));
	$keya = md5(substr($key, 0, 16));
	$keyb = md5(substr($key, 16, 16));
	$keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';

	$cryptkey = $keya.md5($keya.$keyc);
	$key_length = strlen($cryptkey);

	$string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
	$string_length = strlen($string);

	$result = '';
	$box = range(0, 255);

	$rndkey = array();
	for($i = 0; $i <= 255; $i++) {
		$rndkey[$i] = ord($cryptkey[$i % $key_length]);
	}

	for($j = $i = 0; $i < 256; $i++) {
		$j = ($j + $box[$i] + $rndkey[$i]) % 256;
		$tmp = $box[$i];
		$box[$i] = $box[$j];
		$box[$j] = $tmp;
	}

	for($a = $j = $i = 0; $i < $string_length; $i++) {
		$a = ($a + 1) % 256;
		$j = ($j + $box[$a]) % 256;
		$tmp = $box[$a];
		$box[$a] = $box[$j];
		$box[$j] = $tmp;
		$result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
	}

	if($operation == 'DECODE') {
		if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
			return substr($result, 26);
		} else {
			return '';
		}
	} else {
		return $keyc.str_replace('=', '', base64_encode($result));
	}

}

function sp_authencode($string){
	return sp_authcode($string,"ENCODE");
}

function Comments($table,$post_id,$params){
	return  R("Comment/Widget/index",array($table,$post_id,$params));
}

function sp_file_write($file,$content){
	
	if(IS_SAE){
		$s=new SaeStorage();
		$arr=explode('/',ltrim($file,'./'));
		$domain=array_shift($arr);
		$save_path=implode('/',$arr);
		return $s->write($domain,$save_path,$content);
	}else{
		try {
			$fp2 = @fopen( $file , "w" );
			fwrite( $fp2 , $content );
			fclose( $fp2 );
			return true;
		} catch ( Exception $e ) {
			return false;
		}
	}
}

function sp_asset_relative_url($asset_url){
	return str_replace(C("TMPL_PARSE_STRING.__UPLOAD__"), "", $asset_url);
}

function sp_content_page($content,$pagetpl='{first}{prev}&nbsp;{liststart}{list}{listend}&nbsp;{next}{last}'){
	$contents=split('_ueditor_page_break_tag_',$content);
	$totalsize=count($contents);
	import('Page');
	$pagesize=1;
	$PageParam = C("VAR_PAGE");
	$page = new Page($totalsize,$pagesize);
	$page->setLinkWraper("li");
	$page->SetPager('default', $pagetpl, array("listlong" => "6", "first" => "首页", "last" => "尾页", "prev" => "上一页", "next" => "下一页", "list" => "*", "disabledclass" => ""));
	$content=$contents[$page->firstRow];
	$data['content']=$content;
	$data['page']=$page->show('default');
	
	return $data;
}


/**
 * 根据广告名称获取广告内容
 * @param string $ad
 * @return 广告内容
 */

function sp_getad($ad){
	$ad_obj= M("Ad");
	$ad=$ad_obj->field("ad_content")->where("ad_name='$ad'")->find();
	return $ad['ad_content'];
}

/**
 * 根据幻灯片标识获取所有幻灯片
 * @param string $slide 幻灯片标识
 * @return array;
 */
function sp_getslide($slide){
	$slide_obj= M("SlideCat");
	$join = "".C('DB_PREFIX').'slide as b on '.C('DB_PREFIX').'slide_cat.cid =b.slide_cid';
	return $slide_obj->join($join)->where("cat_idname='$slide'")->select();

}

/**
 * 获取所有友情连接
 * @return array
 */
function sp_getlinks(){
	$links_obj= M("Links");
	return  $links_obj->where("link_status=1")->select();
}

