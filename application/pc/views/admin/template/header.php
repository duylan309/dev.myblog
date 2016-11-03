<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Admin <b class="caret"></b></a>
    <ul class="dropdown-menu">
       <!--  <li>
            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
        </li>
        <li>
            <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
        </li> -->
        <li>
            <a target="_blank" href="<?=base_url()?>"><i class="fa fa-fw fa-gear"></i> <?=$lang=="en" ? "View website" : "Xem website"?></a>
        </li>
        <li class="divider"></li>
        <li>
            <a href="<?=base_url().ADMINBASE?>?page=adlogin&action=out"><i class="fa fa-fw fa-power-off"></i> <?php echo $language->LOGOUT; ?></a>
        </li>
    </ul>
</li>