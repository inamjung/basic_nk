<?php

use yii\helpers\Url;
use yii\helpers\Html;
?>

<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
<!--        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>-->

        <ul class="sidebar-menu">
            <li class="header"><h5><div class="label label-default"> รายงาน</div></h5></li> 
            <li> 
                <a href="<?php echo Url::to(['reports/index']); ?>">
                    <i class="fa fa-circle text-blue"></i> 
                    <span>
                        รายงาน
                    </span><small class="label pull-right bg-aqua"></small>
                </a>
            </li>
        </ul>
    </section>

</aside>
