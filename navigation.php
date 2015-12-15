<div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="http://www.siteurl.com">Open Parser</a>
		  <div class="nav-collapse">
            <ul class="nav">
              <li <?php if($is_uni === 'sfo'){echo 'class="active"';} ?>><a href="http://sfo.siteurl.com">SFCO</a></li>
              <li <?php if($is_uni === 'uni2'){echo 'class="active"';} ?>><a href="http://uni2.siteurl.com">Uni2</a></li>
			  <li <?php if($is_uni === 'x1'){echo 'class="active"';} ?>><a href="http://x1.siteurl.com">Ex1</a></li>
			  <li <?php if($is_uni === 'x2'){echo 'class="active"';} ?>><a href="http://x2.siteurl.com">Ex2</a></li>
			  <li <?php if($is_uni === 'nova'){echo 'class="active"';} ?>><a href="http://nova.siteurl.com">Nova</a></li>
			  <li <?php if($is_uni === 'conq'){echo 'class="active"';} ?>><a href="http://conquest.siteurl.com">Conq</a></li>
			  <li <?php if($is_uni === 'conq2'){echo 'class="active"';} ?>><a href="http://conquest2.siteurl.com">Conq2</a></li>
			  <li <?php if($is_uni === 'guns'){echo 'class="active"';} ?>><a href="http://guns.siteurl.com">Guns</a></li>
			  <li <?php if($is_uni === 'uni3'){echo 'class="active"';} ?>><a href="http://uni3.siteurl.com">Uni 3</a></li>
			  <li <?php if($is_uni === 'erad'){echo 'class="active"';} ?>><a href="http://eradeon.siteurl.com">Erad</a></li>
			  <li <?php if($is_uni === 'erad2'){echo 'class="active"';} ?>><a href="http://eradeon2.siteurl.com">Erad2</a></li>
			  <li <?php if($is_uni === 'erad3'){echo 'class="active"';} ?>><a href="http://eradeon3.siteurl.com">Erad3</a></li>
			  <li <?php if($is_uni === 'sde'){echo 'class="active"';} ?>><a href="http://sde.siteurl.com">SDE</a></li>
			  <li <?php if($is_uni === 'sden'){echo 'class="active"';} ?>><a href="http://sdenova.siteurl.com">SDEN</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
	<div class="container">
	<?php if ($is_uni !== 'null'){ include('sub-navigation.php');}?>