<?php 
    $week_days  = $this->crud_model->date_week(date('Y-m-d'));
    $week_name_days  = $this->crud_model->panelDate();
?>
<div class="white-box">
    <div class="os-tabs-w">
        <div class="os-tabs-controls">
            <ul class="navx nav-tabs">
                <li class="nav-item text-center">
                    <a class="nav-link <?php  if($page_name == "patients") echo 'current'; ?>" href="<?php echo base_url();?>doctor/patients/">
                        <div class="navWidget"><i class="picons-thin-icon-thin-0489_storehouse_storage"></i></div> <span>Pacientes de Atenun</span>
                    </a>
                </li>
                <li class="nav-item text-center">
                    <a class="nav-link <?php  if($page_name == "patients_insurance") echo 'current'; ?>" href="<?php echo base_url();?>doctor/patients_insurance/">
                        <div class="navWidget"><i class="picons-thin-icon-thin-0823_hospital_ill_medicine_doctor_ambulance"></i></div> <span>Paciente de Empresas</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div id="main-content">
    <div class="row">
        <div class="col-sm-12">
            <div class="title-header">
                <h3 class="module-title">Tus pacientes</h3>
                <a class="add-buton pull-right" href="<?php echo base_url().'doctor/patients_add/1'?>">+ Agregar
                    Paciente</a>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="table-responsive">
                <table class="table table-padded" id="user_data">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Paciente</th>
                            <th>Género</th>
                            <th>Contactos</th>
                            <th>Última cita</th>
                            <th>Tipo de paciente</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
$('.os-dropdown-trigger').on('mouseenter', function() {
    $(this).addClass('over');
});
$('.os-dropdown-trigger').on('mouseleave', function() {
    $(this).removeClass('over');
});
</script>

<script type="text/javascript" language="javascript">
$(document).ready(function() {
    var dataTable = $('#user_data').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: "<?php echo base_url() . 'doctor/getTable/patients/1'; ?>",
            type: "POST"
        },

        "columnDefs": [{
            "targets": 0,
            "orderable": false,
        }, ],
    });
});
</script>
<script type="text/javascript">
let timerInterval

function executeExample(chat_id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "Toma en cuenta que solo se eliminará la copia de tu mensaje.",
        type: 'info',
        showCancelButton: true,
        confirmButtonColor: '#9fd13b',
        cancelButtonColor: '#fd4f57',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            Swal.fire({
                title: 'Eliminando mensaje',
                titleTextColor: '#000',
                html: 'Esta ventana se cerrará en <strong></strong>.',
                timer: 2000,
                onBeforeOpen: () => {
                    Swal.showLoading()
                    timerInterval = setInterval(() => {
                        Swal.getContent().querySelector('strong').textContent = Swal
                            .getTimerLeft()
                    }, 100)
                },
                onClose: () => {
                    clearInterval(timerInterval)
                }
            })
            location.href = "<?php echo base_url();?>doctor/chat/delete/" + chat_id;
        }
    })
}
</script>
<script type="text/javascript">
function delete_patient(patient_id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "También se eliminará toda la información asociada a este paciente.",
        type: 'info',
        showCancelButton: true,
        confirmButtonColor: '#9fd13b',
        cancelButtonColor: '#fd4f57',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            location.href = "<?php echo base_url();?>doctor/patients/delete/" + patient_id;
        }
    })
}

function loadPatients(idd) {
    $('input#contact').addClass('loading');
    consulta = $("#contact").val();
    $("#results").queue(function(n) {
        if ($("#contact").length == 0) {
            $("#results").removeData()
        }
        $.ajax({
            type: "POST",
            url: '<?php echo base_url();?>doctor/get_patients_list',
            dataType: "html",
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status);


                alert("Ups! Algo salio mal.");
                $("input#contact").removeClass("loading");
            },
            success: function(data) {


                $("#results").html(data);
                n();
                $("input#contact").removeClass("loading");
            }
        });
    });
}
</script>