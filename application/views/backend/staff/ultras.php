<?php 
    $week_days  = $this->crud_model->date_week(date('Y-m-d'));
    $week_name_days  = $this->crud_model->panelDate();
?>

<div id="main-content"> 
    <div class="row">
        <div class="col-sm-12">
            <div class="title-header">
                <h3 class="module-title">Ordenes de ultrasonidos</h3>
                <a class="add-buton pull-right" href="<?php echo base_url().'staff/patient_service_add/2'?>">+ Nueva orden</a> 
            </div>
        </div>
        <div class="col-sm-12">
            <div class="row">
    <div class="col-sm-12">

        <?php 
            $refresh_query  = $this->db->order_by('patient_service_id','desc')->get_where('patient_service',array('type'=>2));
            if($refresh_query->num_rows() > 0):
                $cont= 1;
            ?>
        <table class="table table-padded dataTable no-footer" id="user_data">
            <thead>
                <tr style="background-color:#f9fbfc; color:#59636d">
                    <th>Código</th>
                    <th>Especialista</th>
                    <th>Exámen</th>
                    <th>Fecha & Hora</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
        </table>
        <?php else: ?>
        <div class="col-sm-12"><br>
            <center>
                <h5 class="poppins">Aún no hay ordenes de ultrasonidos</h5><br><img src="<?php echo base_url() ?>public/uploads/medicamentos.svg" style="max-width:20%;">
            </center>
        </div>
        <?php endif; ?>
    </div>
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
            url: "<?php echo base_url() . 'staff/getTable/patient_service/2'; ?>",
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
            location.href = "<?php echo base_url();?>staff/chat/delete/" + chat_id;
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
        if (result.value) 
        {
            location.href = "<?php echo base_url();?>staff/patients/delete/"+patient_id;
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
            url: '<?php echo base_url();?>staff/get_patients_list',
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

function delete_user(user, user_id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "También se eliminará toda la información asociada.",
        type: 'info',
        showCancelButton: true,
        confirmButtonColor: '#9fd13b',
        cancelButtonColor: '#fd4f57',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: "GET",
                url: "<?php echo base_url();?><?php echo $this->session->userdata('login_type');?>/" + user + "/delete/" + user_id,
                success: function(data) {
                    console.log(data);
                    // show response from the php script.
                    if (data != 'Error') {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 8000
                        });
                        Toast.fire({
                            type: 'success',
                            title: 'Eliminado Correctamente'
                        })

                        location.reload();

                    }
                },
                error: function(xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    alert(err.Message);
                },
            });


        }
    })
}
</script>