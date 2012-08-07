<?php

/*
  * 判断url中是否包含slug
  */
if(!empty($cat_slug)){
	$query=$this->M_item->get_all_item($limit,$offset,$cat_slug);
}else{
	$query=$this->M_item->get_all_item($limit,$offset);
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
	<title><?php echo $site_name;?></title>
	<script src="<?php echo base_url()?>assets/js/kissy/build/kissy-min.js"></script>
	<script src="<?php echo base_url()?>assets/js/home.js"></script>
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url()?>assets/bootstrap.css" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url()?>assets/index.css?d=20120705" />
	<!--[if lt IE 9]>
	<script src="<?php echo base_url()?>assets/js/html5shiv.js"></script>
	<![endif]-->
</head>
<body>

<header id="branding" role="banner">
    <div id="site-title">
        <h1>
            <a href="<?php echo site_url();?>" title="<?php echo $site_name;?>" rel="home" class="logo"><?php echo $site_name;?></a>
        </h1>
			<div id="site-op" class="hide">
				<a href="<?php echo site_url('login/oauth_qq')?>" title="使用QQ帐号登录33号铺" class="qq-login">QQ登录</a>
			</div>
    </div>

</header>

<nav class="main_nav">
			<div>
				<ul class="menu">
					<?php
						$is_home = '';
						if(empty($cat_slug)){
							$is_home = 'current-menu-item';
						}
						?>
					<li class="<?php echo $is_home;?>"><a href="<?php echo site_url()?>">全部</a></li>
					<?php
					   foreach($cat->result() as $row){
							$is_current = '';
							if(!empty($cat_slug) && $row->cat_slug == $cat_slug){
								$is_current = 'current-menu-item';
							}
						   echo '<li class="'.$is_current.'"><a href="'.site_url('cat/'.$row->cat_slug).'">'.$row->cat_name.'</a></li>';
						}
					 ?>
				</ul>
			</div>
	</nav>

<div id="wrapper">

	<?php if($query->num_rows()>0){ ?>
	<div class="goods-all transitions-enabled masonry">
	<?php foreach ($query->result() as $array):
	//条目
		?>

		<article class="goods">
			<div class="entry-content">
			<div class="goods-pic">
				<a target="_black" href="<?php echo site_url('home/redirect').'/'.$array->id ?>"">
				<img src="<?php echo base_url()?>assets/img/s.gif " data-ks-lazyload="<?php echo $img_url_prefix.$array->img_url ?>" class="thumbnail" alt="<?php echo $array->title ?>">
        </a>
			</div>
				<div class="op"><div class="desc"><?php echo $array->title ?>  / <strong class="price"> &yen; <?php echo $array->price ?></strong></div>
				<div class="buttonline">
					<a href="<?php echo site_url('home/redirect').'/'.$array->id ?>"  class="btn btn-success" target="_blank">去购买</a>
				</div></div>
			</div>
		</article>
	<?php endforeach;?>
	</div>
        <div class="pagenav_wrapper">
            <div class="pagenav">
            		<?=$pagination;?>
            	</div>
        </div><!-- .pagenav_wrapper -->

    	<?php } ?>
</div>

<footer id="ft" class="main-footer" role="contentinfo">
		<p><a href="<?php echo site_url();?>" title="<?php echo $site_name;?>"><?php echo $site_name;?></a> ©   • Powered by <a href="https://github.com/yuguo/33pu" title="Powered by 33号铺, 一个开源的购物推荐系统">33号铺 </a>sae powered by <a href="http://meikaili.com" target="_blank">美凯丽</a></p>
</footer>


<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F98277a762b4aa9385877d7b66711a3cb' type='text/javascript'%3E%3C/script%3E"));
</script>

</body>
</html>
