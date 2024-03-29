<style>

</style>
<link href="<?php echo base_url();?>public/assets/input/script.css" media="all" rel="stylesheet">
    <link href="<?php echo base_url();?>public/assets/input/jquery.fileuploader-theme-dragdrop.css" rel="stylesheet">
    <link href="<?php echo base_url();?>public/assets/input/font-fileuploader.css" rel="stylesheet">
<div class="white-box">
    <div class="os-tabs-w">
        <div class="os-tabs-controls">
            <ul class="navx nav-tabs">
                <li class="nav-item text-center">
                    <a class="nav-link current" href="<?php echo base_url();?>doctor/whatsapp/">
                        <div class="navWidget"><i class="picons-thin-icon-thin-0317_send_post_paper_plane"></i></div> <span>Enviar Mensaje</span>
                    </a>
                </li>
                <li class="nav-item text-center">
                    <a class="nav-link " href="<?php echo base_url();?>doctor/whatsapp_notifications/">
                        <div class="navWidget"><i class="picons-thin-icon-thin-0289_mobile_phone_call_ringing_nfc"></i></div> <span>Notificaciones</span>
                    </a>
                </li>
                <!--<li class="nav-item text-center">
                    <a class="nav-link " href="<?php echo base_url();?>doctor/whatsapp_notifications/">
                        <div class="navWidget"><i class="picons-thin-icon-thin-0065_bullet_list_view"></i></div> <span>Notificaciones enviadas</span>
                    </a>
                </li>-->
            </ul>
        </div>
    </div>
</div>
<div id="main-content">
    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                <div class="card-h">
                    <h5 class="card-caption">Enviar mensajes a pacientes u otros usuarios con whatsapp</h5>
                </div>
                <div class="card-b">
                    <form action="<?php echo base_url();?>doctor/whatsapp/send" method="POST" enctype="multipart/form-data" id="formWhatsapp">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="middles">
                                    <label>
                                        <input type="radio" id="exist" value="0" onclick="validate(0)" name="user_type" checked="" required="">
                                        <div class="front-end box">
                                            <span>Pacientes</span>
                                        </div>
                                    </label>
                                    <label>
                                        <input type="radio" id="new" value="1" onclick="validate(1)" name="user_type">
                                        <div class="back-end box">
                                            <span>Usuarios</span>
                                        </div>
                                    </label>
                                </div>
                                <div id="patients">
                                    <div class="form-group">
                                        <label for="simpleinput">Pacientes</label><span class="error_show" id="errorpat"></span>
                                        <select onchange="getPatients(this.value)" class="itemName form-control select2" style="width:100%" name="insurance_id">
                                            <option value="0">Todos</option>
                                            <?php 
									                $this->db->where('status !=', '0');
                                                    $this->db->where('clinic_id', $this->session->userdata('current_clinic'));
									                $query = $this->db->get('insurance')->result_array();
                                                    foreach($query as $pat):
                                                       
                                                        ?>
                                            <option value="<?php echo $pat['insurance_id'];?>"><?php echo $pat['name'];?></option>

                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="simpleinput">Seleccionar pacientes</label><span class="error_show" id="errorpat"></span>
                                        <select class="itemName form-control select2" style="width:100%" name="patient_id" id="patients_list">

                                        </select>
                                    </div>
                                </div>
                                <div id="users" style="display:none">
                                    <div class="form-group">
                                        <label for="simpleinput">Usuarios</label><span class="error_show" id="errorpat"></span>
                                        <select onchange="getUsers(this.value)" class="itemName form-control select2" style="width:100%" name="category_id">
                                            <option value="0">Todos</option>
                                            <option value="admin">Administradores</option>
                                            <option value="docs">Doctores</option>
                                            <option value="1">Enfermeros</option>
                                            <option value="2">Recepcionistas</option>
                                            <option value="3">Proveedores</option>
                                            <option value="4">Vendedores</option>
                                            <option value="5">Contadores</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="simpleinput">Seleccionar pacientes</label><span class="error_show" id="errorpat"></span>
                                        <select class="itemName form-control select2" style="width:100%" name="staff_id" id="users_list">

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="simpleinput">Mensaje</label><span class="error_show" id="errorpat"></span>
                                    <textarea class="form-control" rows="5" name="message" id="message" required></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="simpleinput">Archivo</label><span class="error_show" id="errorpat"></span>
                                    <input type="file" name="archivo" class="form-control" >
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-success" style="display: flex;"> Enviar </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url();?>public/assets/theme/js/select2.min.js"></script>
<script src="<?php echo base_url();?>public/assets/input/jquery.fileuploader.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(function() {

    $('#formWhatsapp').submit(function() {
        // Deshabilitar el botón de envío del formulario
            $('button[type="submit"]').attr('disabled', 'disabled');
            $('button[type="submit"]').html('Enviando...');
            $('button[type="submit"]').append('<i class="loading" ></i>');
      });

    validate(0);
    getPatients(0);
    getUsers(0);
    $('.select2').select2();

    $('input[name="archivo"]').fileuploader
    ({
        theme: 'One-button', 
    });

          
})

function validate(value) {
    if (value == 0) {
        $("#patients").show();
        $("#users").hide();
    } else {
        $("#users").show();
        $("#patients").hide();
    }

}

function getPatients(value) {
    $.ajax({
        url: "<?php echo base_url().'doctor/getPatientsWhatsapp/';?>",
        type: "POST",
        data: {
            insurance_id: value,
        },
        success: function(response) {


            $('#patients_list').html(response);
            // console.log(response);
        },
        error: function() {
            console.log("error");
        }
    });

}

function getUsers(value) {
    console.log(value);
    $.ajax({
        url: "<?php echo base_url().'doctor/getStaffWhatsapp/';?>",
        type: "POST",
        data: {
            category_id: value,
        },
        success: function(response) {


            $('#users_list').html(response);
            // console.log(response);
        },
        error: function() {
            console.log("error");
        }
    });

}
</script>