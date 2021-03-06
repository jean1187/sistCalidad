<!DOCTYPE HTML>
<html>
	<head>
<!-- ********************************************************************************************************** -->
                <?php 
                    echo link_tag(base_url().'/imagenes/icons/favicon.ico', 'shortcut icon', 'image/ico');
                ?>
<!-- ********************************************************************************************************** -->
                <!-- ********** Estilos y Js Generales  ***********-->
                <?php 
                $meta = array(
                        array('name' => 'robots', 'content' => 'no-cache'),
                        array('name' => 'description', 'content' => 'Direccion de Proyectos Edo Aragua'),
                        array('name' => 'keywords', 'content' => 'proyectos aragua,direccion de proyectos,edo aragua,proyectos'),
                        array('name' => 'robots', 'content' => 'no-cache'),
                        array('name' => 'Content-type', 'content' => 'text/html; charset=utf-8', 'type' => 'equiv')
                    );

                    echo meta($meta); 
                
                    echo link_tag(array(
                                      'href' => base_url().'/css/style.css',
                                      'rel' => 'stylesheet',
                                      'type' => 'text/css',
                                      'media' => 'screen'
                                   ));
                ?>
                <script type="text/javascript"  src='<?php echo base_url()?>js/jquery.js'></script>
                <script type="text/javascript"  src='<?php echo base_url()?>js/jsonvalidator.js'></script>
<!-- ********************************************************************************************************** -->
                <!-- ********** Js del Menu  ***********-->
                <?php 
                    echo link_tag(base_url()."css/apycomMenu/menu.css");
                ?>                
                <script type="text/javascript" src="<?php echo base_url()?>js/apycomMenu/menu.js"></script>
<!-- ********************************************************************************************************** -->
                 <!-- ********** 960 Grid  ***********-->
                <?php 
                   // echo link_tag('/css/960Grid/reset.css');
                    echo link_tag(base_url().'css/960Grid/text.css');
                    echo link_tag(base_url().'css/960Grid/960_24_col.css');
                ?>                     

                 
<!-- ********************************************************************************************************** -->          

                <!-- ********** jquery  ***********-->
                <link type="text/css" href="<?php echo base_url()?>css/jquery_ui/jquery-ui.css" media="screen" rel="stylesheet" />
                <script type="text/javascript"  src='<?php echo base_url()?>js/jquery_ui/jquery-ui.js'></script>

                <!-- ********** jqgrid  ***********-->                
                <script type="text/javascript"  src='<?php echo base_url()?>js/jqgrid/js/language/grid_locale_sp.js'></script>
                <script type="text/javascript"  src='<?php echo base_url()?>js/jqgrid/js/jqgrid.js'></script>
                
                <link type="text/css" href="<?php echo base_url()?>js/jqgrid/css/ui_jqgrid.css" media="screen" rel="stylesheet" />
                <script type="text/javascript"  src='<?php echo base_url()?>js/global_jqgrid.js'></script>                
                 
<!-- ********************************************************************************************************** -->

                 <!-- ********** achtung ***********-->
                <?php  echo link_tag(base_url().'/css/achtung/ui.achtung-min.css');  ?>                     
                 <script type="text/javascript"  src='<?php echo base_url()?>/js/achtung/ui.achtung-min.js'></script>
                 
                 <!-- ********** global ***********-->
                 <script type="text/javascript"  src='<?php echo base_url()?>/js/global.js'></script>
                 
    <title><?php echo $title?></title>
</head>
<body>
<div  class="container_24 container_principal"><!-- cierra en pie -->
    
        <header id="cabecera" >
            <div class="grid_2 suffix_1">
                    <img  id="logo" src="<?php echo base_url()?>/imagenes/logo.png">
            </div>
            <div class="grid_14" id="titulo">
                <h3><?php echo $title?></h3>
            </div>    
            <!-- Detalle del Usuario Logueado -->
            <div class="grid_6 omega alpha">
                    <div class="grid_7">
                        <b>Usuario : </b><?php echo $user["nombre"]." ".$user["apellido"]?>
                    </div>    
                    <div class="clear"></div>
                    <div class="grid_7">
                        <b>Departamento : </b><?php echo $user["departamento"]?>
                    </div>                    
                    <div class="clear"></div>
                    <div class="grid_7">
                        <b>Carga : </b>{elapsed_time}
                    </div>                    
            </div>  
        </header>
       <div class="clear"></div>
                            <div class="grid_24 container_menu">
                                <ul class="menu">
                                    <li><a href="<?php if($user["url_index"]!="") echo site_url($user["url_index"]); else if($user["url_grupo"]!="") echo site_url($user["url_grupo"]); else echo base_url();?>" ><span>Inicio</span></a></li>
                                            <?php
                                                echo $user["menu"]
                                            ?>
                                    <li class="last"><a href="<?php echo site_url('login/salir')?>"><span>salir</span></a></li>
                                </ul>
                            </div>

                            <div id="copyright">Copyright &copy; 2011 <a href="http://apycom.com/">Apycom jQuery Menus</a></div>
                            <br/><br/><br/>
