<div class="container">

  <!-- Outer Row -->
  <div class="row justify-content-center">

    <div class="col-xl-10 col-lg-12 col-md-9 mt-4">

      <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
          <!-- Nested Row within Card Body -->
          <div class="row mt-4">
            <div class="col-lg-6 d-none d-lg-block">
              <img src="<?= base_url('assets/img/garuda1.png');?>" width="400" height="400" style="margin-left: 55px;">
            </div>
            <div class="col-lg-6">
              <div class="p-5">
                <div class="text-left mb-4">
                  <h1 class="h4 text-gray-900">Login</h1>
                  <small>Welcome back, please login to your account. </small>
                </div>
                <?= $this->session->flashdata('message'); ?>
                <form class="user" method="POST" action="<?= base_url('index.php/auth'); ?>">
                  <div class="form-group">
                    <input type="text" class="form-control form-control-user" id="username" name="username"
                      placeholder="Username">
                    <?= form_error('username','<small class="text-danger pl-3">','</small>'); ?>
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-user" id="password" name="password"
                      placeholder="Password">
                    <?= form_error('password','<small class="text-danger pl-3">','</small>'); ?>
                  </div>
                  <div class="wrap-input100 validate-input m-b-18 label-input-100"
                    style="font-size: 15px; margin-left: 15px;"><?php
                    $cpt = generateCode();
                    echo $cpt['text'];
                     ?></div>
                  <div class="form-group">
                    <?= $this->session->userdata('msgcaptcha'); ?>
                    <input type="password" class="form-control form-control-user" name="cpt" id="cpt"
                      placeholder="Enter captcha ">
                    <?= form_error('cpt','<small class="text-danger pl-3">','</small>'); ?>
                    <input type="hidden" name="rescpt" id="rescpt" value="<?=$cpt['res']?>" />
                  </div>
                  <button type="submit" class="btn btn-primary btn-user btn-block">
                    Login
                  </button>

                </form>

              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>

</div>