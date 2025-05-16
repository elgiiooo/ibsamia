<?php 
 
    require_once ('apis/tokencheckWeb.php');
    
    $var=tokenDecode($token);

    $string_sin_modificar = $var; 
    $var2 = substr($string_sin_modificar, 2); 
    $usuario = json_decode($var2);

    session_start();
    if ($_SESSION["tok"] == ''){
        $haySesion = 0;
    }else{
        $haySesion = 1;
    }

?>
<link href="css/style.css" rel="stylesheet">

<link rel="stylesheet" href="pagination/styles.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js" integrity="sha512-nnzkI2u2Dy6HMnzMIkh7CPd1KX445z38XIu4jG1jGw7x5tSL3VBjE44dY4ihMU1ijAQV930SPM12cCFrB18sVw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="js/bootstrap.bundle-4.5.2.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


<!-- Include the plugin's CSS and JS: -->
<script type="text/javascript" src="js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="css/bootstrap-multiselect.css" type="text/css" />

<style>
    .numero_utenti_grande {
        font-size: 50px;
        font-weight: 600;
        color: #012e6c;
    }

    .target_utenti {
        padding: 20px;
        margin: 5px;
        border-radius: 15px;
        background-color: #e5eaf0;
        color: #6d80a3;
    }

    #busqueda {
        width: 100%;
        margin-left: 10px;
        margin-right: 12px;
        background: none;
        border: none;
        outline: 0px;
        color: #7C4199;
    }

    .contenedor_busqueda {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 250px;
        border: 2px solid #113068;
        border-radius: 10px;
        padding: 30px;
        border-radius: 30px;
        padding: 15px;
        cursor: pointer;
    }

    .cabecera_utenti {
        font-weight: 800;
        color: #002F6C;
        border: 1px solid #E6E6E6;
        border-radius: 8px 8px 0px 0px;
        padding: 10px 0px;
    }

    .listado_utenti {
        padding: 0px 0px;
        border: 1px solid var(--black-10, #E6E6E6);
        background-color: #FFF;
        color: #002F6C;
        align-items: center;
    }

    .btn-group {

        background: #FFF;
        padding: 0px;
        width: 100%;
        margin-top: 10px;
        margin-bottom: 30px;
        cursor: pointer;
        font-size: 14px;
        color: #002F6C;
        font-weight: 400;
        border-radius: 10px;
    }

    .text-center {
        text-align: left !important;
        color: var(--secondary-uno, #002F6C);

        /* Label/14px Bold */
        border-radius: 10px;
        border: none;
        font-family: Montserrat;
        font-size: 14px;
        font-style: normal;
        font-weight: 700;
        line-height: 130%;
        /* 18.2px */
    }


    .col-1,
    .col-2 {
        cursor: pointer;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .switch {
        margin: 0px;
    }


    .cambiar_btn_pagination {
        display: block !important;
        text-align: end;
    }

    .btn-group>.btn-group:not(:last-child)>.btn,
    .btn-group>.btn.dropdown-toggle-split:first-child,
    .btn-group>.btn:not(:last-child):not(.dropdown-toggle) {
        color: #002F6C;
        background-color: #FFFFFF;
        border-color: #002F6C;
        border-radius: 20px;
        border: none;
        width: 50px;
        margin: 4px !important;
    }

    .btn-primary:not(:disabled):not(.disabled):active,
    .btn-primary:not(:disabled):not(.disabled).active,
    .show>.btn-primary.dropdown-toggle {
        color: #fff;
        background-color: #002F6C;
        border-color: #002F6C;
        border-radius: 20px;
        border: none;
        width: 50px;
        margin: 4px !important;
    }

    .btn-group>.btn-group:not(:first-child)>.btn,
    .btn-group>.btn:nth-child(n+3),
    .btn-group>:not(.btn-check)+.btn {
        color: #fff;
        background-color: #FFF;
        border-color: #002F6C;
        border-radius: 20px;
        border: none;
        width: 50px;
        margin: 4px !important;
    }


    .table thead th {
        vertical-align: bottom;
        border: 1px solid #E6E6E6;
    }

    .table th,
    .table td {
        padding: 0.5rem;
        vertical-align: top;
        border: 1px solid #E6E6E6;
        color: #002F6C;
    }

    .btn_filter {
        display: flex;
        padding: 6px 19px;
        justify-content: center;
        align-items: center;
        gap: 3px;
        border-radius: 20px;
        border: 1px solid #E6E6E6;
        background: #FFF;
        margin: 0px 10px;
        color: #A6A6A6;

    }

    .btn_active {
        background: #002F6C;
        color: #FFF;
    }

    .truncate {
        max-width: 150px;
    }

</style>

<div id="cabeceraIndex">

    <div style="display: flex;align-items: center;justify-content: space-between;width: 100%;max-width: 1400px;margin: 0 auto;">
        <div class="titulo_cabecera">Events</div>
        <div style="display: flex;align-items: center">
            <div class="estilo_buscar_cabecera" style="display: flex;flex-direction: row;align-items: center;"><img src="img/search.svg"><input id="searchField" type="text" style="border:none"><img src="img/x.svg"></div>
            <div class="estilo_btn_cabecera" onclick="crea_event()">Create event <img src="img/mas.svg"> </div>
        </div>

    </div>
</div>
<div class="container" style="padding:50px;max-width:100%;">

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-3 " style="display: flex;justify-content: flex-start;align-items: flex-end;">
            <div style="border-radius: 12px;border: 1px solid var(--black-10, #E6E6E6);background: var(--black-white, #FFF);width:100%;display: flex;align-items: center;justify-content: space-between;padding:20px 24px;height:100%">
                <div>
                    <p style="font-size: 18px;">Total events</p>
                    <p style="margin-bottom:0px;font-size: 20px;"><b id="event_totals"></b></p>
                </div>
                <div><img src="img/events2.svg"> </div>
            </div>
        </div>

    </div>
    <br>
    <div class="row" style="background-color:#FFF;border-radius:10px;padding:0px;">
        <div class="col-xs-12 col-sm-12 col-md-12" style="display: flex;justify-content: flex-end;">
            <br>
            <div class="page-container" style="width:100%">
                <div class="row mt-5 mb-3 align-items-center">
                    <div class="col-md-5" style="display:flex">

                    </div>
                    <div class="col-md-2 text-right">
                        <!--<input type="text" class="form-control" placeholder="Search in table..." id="searchField">-->
                        <img src="img/download_2_2x.png" width="163" style="cursor:pointer" onclick="download()">

                    </div>
                    <div class="col-md-2 ">
                        <div class="d-flex justify-content-center">
                            <select id="country" name="country" onchange="cargar_listado_country()" style="display: flex;height: 28px;padding: 5px 10px;justify-content: center;align-items: center;gap: 10px;border-radius: 10px;border: 1px solid #002F6C;color: var(--secondary-uno, #002F6C);font-family: Montserrat;font-size: 14px;font-style: normal;font-weight: 700;line-height: 130%; ">
                                <option value="">Select Country</option>
                                <option value="Spain">Spain</option>
                                <option value="Italy">Italy</option>
                                <option value="France">France</option>
                            </select>
                        </div>

                    </div>
                    <div class="col-md-3">
                        <div class="d-flex justify-content-end">

                            <select class="custom-select" name="rowsPerPage" id="changeRows" style="display: flex;height: 28px;padding: 5px 10px;justify-content: center;align-items: center;gap: 10px;border-radius: 10px;border: 1px solid #002F6C;color: var(--secondary-uno, #002F6C);font-family: Montserrat;font-size: 14px;font-style: normal;font-weight: 700;line-height: 130%; ">
                                <option value="10" selected>Items per page 10</option>
                                <option value="20">Items per page 20</option>
                                <option value="30">Items per page 30</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div id="root"></div>
            </div>
        </div>

        <!--<div class="col-xs-12 col-sm-12 col-md-12" style="margin-top:50px;max-height: 65vh;overflow: auto;">
            <div class="row cabecera_utenti">
                <div class="col-2">Tools</div>
                <div class="col-1">ID</div>
                <div class="col-1">Name</div>
                <div class="col-1">Surname</div>
                <div class="col-2">Email</div>
                <div class="col-2">Country</div>
                <div class="col-2">Role</div>
                <div class="col-1">Activate</div>
            </div>
            <div class="listado_cargado">

            </div>
        </div>-->

    </div>

</div>

<!--pagination-->
<script src="pagination/table-sortable.js"></script>
<script>
    $(document).ready(function() {
        $sesion = <?php echo $haySesion; ?>;
        if ($sesion == 0) {
            //            alert("Sessione scaduta. Per favore esegui l'accesso di nuovo.");
            //            window.location.reload();
        }
        $("#fondoLoad").hide();
        $("#gifLoad").hide();


        /*$('#country').multiselect();
        $(".multiselect-selected-text").html('Select Country')*/


        cargar_listado()
        cargar_country()

    });


    function cambiarActivo(id) {

        $.ajax({
            type: "POST",
            url: "apis/events.php",
            data: {
                method: "updateAttivazione",
                id: id
            },
            success: function(data) {
                //$('#content').fadeIn(1000).html(data);
                if (data == "Token ERROR") {
                    alert("Sessione scaduta. Per favore esegui l'accesso di nuovo.");
                    document.location = "index.html";
                }
            }
        });
    }

    function delete_event(id) {
        if (confirm("Sei sicuro di voler eliminare il event?") == true) {
            $.ajax({
                type: "POST",
                url: "apis/events.php",
                data: {
                    method: "delete",
                    id: id
                },
                success: function(data) {
                    //$('#event').fadeIn(1000).html(data);

                    if (data == "Token ERROR") {
                        alert("Sessione scaduta. Per favore esegui l'accesso di nuovo.");
                        document.location = "index.html";
                    } else if (data == "OK+") {
                        events();
                    }
                }
            });
        }
    }

    function ver_event(extra, id) {
        reiniciarCountdown();

        $(".btn_menu_1").removeClass('item_seleccionado')
        $(".btn_menu_2").removeClass('item_seleccionado')
        $(".btn_menu_3").removeClass('item_seleccionado')
        $(".btn_menu_4").removeClass('item_seleccionado')
        $(".btn_menu_5").addClass('item_seleccionado')
        $(".btn_menu_6").removeClass('item_seleccionado')

        $("#main-content").empty();
        $("#main-content").load('view_event.php', {
            id_actual: id
        });


        $("#fondoLoad").hide();
        $("#gifLoad").hide();
        document.cookie = "pagina=events";
    }

    function update_event(id) {
        reiniciarCountdown();

        $(".btn_menu_1").removeClass('item_seleccionado')
        $(".btn_menu_2").removeClass('item_seleccionado')
        $(".btn_menu_3").removeClass('item_seleccionado')
        $(".btn_menu_4").removeClass('item_seleccionado')
        $(".btn_menu_5").addClass('item_seleccionado')
        $(".btn_menu_6").removeClass('item_seleccionado')

        $("#main-content").empty();
        $("#main-content").load('update_event.php', {
            id_actual: id
        });


        $("#fondoLoad").hide();
        $("#gifLoad").hide();
        document.cookie = "pagina=events";
    }


    function duplicate_event(id) {

        reiniciarCountdown();

        $(".btn_menu_1").removeClass('item_seleccionado')
        $(".btn_menu_2").removeClass('item_seleccionado')
        $(".btn_menu_3").removeClass('item_seleccionado')
        $(".btn_menu_4").removeClass('item_seleccionado')
        $(".btn_menu_5").addClass('item_seleccionado')
        $(".btn_menu_6").removeClass('item_seleccionado')

        $("#main-content").empty();
        $("#main-content").load('duplica_event.php', {
            id_actual: id
        });

        $("#fondoLoad").hide();
        $("#gifLoad").hide();
        document.cookie = "pagina=events";


    }




    function descargarcsv() {
        document.location = "apis/descarga_events.php";
    }


    function cargar_listado() {
        let total_filas = 0;

        $.ajax({
            type: "POST",
            url: "apis/events.php",
            data: {
                method: "get_all"
            },
            success: function(data) {
                //$('#content').fadeIn(1000).html(data);

                if (data == "Token ERROR") {
                    alert("Sessione scaduta. Per favore esegui l'accesso di nuovo.");
                    document.location = "index.html";
                } else if (data == '') {
                    alert('There are no events')
                } else {

                    data = JSON.parse(data);
                    ////console.log(data)


                    total_filas = data.length;
                    $("#event_totals").html(total_filas);

                    let listado = [];

                    for (i = 0; i < data.length; i++) {

                        var experts = '';
                        for (j = 0; j < data[i].experts.length; j++) {
                            if ((j + 1) != data[i].experts.length) {
                                experts = experts + data[i].experts[j].name + ' ' + data[i].experts[j].surname + ', ';
                            } else {
                                experts = experts + data[i].experts[j].name + ' ' + data[i].experts[j].surname;
                            }
                        }
                        var id = parseInt(data[i].id);
                        var description_en = data[i].description_en.replace("<p>", '');
                        description_en = description_en.substr(0, 20) + '...';

                        var objeto = {
                            tools: '<div style="display:flex"><img src="img/duplicate.svg" style="cursor:pointer;" onclick="duplicate_event(' + data[i].id + ')"><img src="img/edit2.svg" style="cursor:pointer;margin-left:5px;margin-right:5px" onclick="update_event(' + data[i].id + ')"><img src="img/delete.svg" style="cursor:pointer" onclick="delete_event(' + data[i].id + ')"></div>',
                            id: id,
                            title: '<span style="cursor:pointer" class="truncate" onclick="ver_event(\'' + data[i].title_en + '\',' + data[i].id + ')">' + data[i].title_en + '</div>',
                            date: '<span style="cursor:pointer" onclick="ver_event(\'' + data[i].start_date + '\',' + data[i].id + ')">' + data[i].start_date + '</div>',
                            time: '<span style="cursor:pointer" onclick="ver_event(\'' + data[i].start_time + '\',' + data[i].id + ')">' + data[i].start_time + '</div>',
                            location: '<span style="cursor:pointer" class="truncate" onclick="ver_event(\'' + data[i].location + '\',' + data[i].id + ')">' + data[i].location + '</div>',
                            experts: '<span style="cursor:pointer" class="truncate" onclick="ver_event(\'' + data[i].experts + '\',' + data[i].id + ')">' + experts + '</div>',
                            description: '<span style="cursor:pointer" onclick="ver_event(\'' + description_en + '\',' + data[i].id + ')">' + description_en + '</div>',
                            media_file: '<span style="cursor:pointer" class="truncate" onclick="ver_event(\'' + data[i].media_file + '\',' + data[i].id + ')">' + data[i].media_file + '</div>',
                            past: '<span style="cursor:pointer" onclick="ver_event(\'' + data[i].past + '\',' + data[i].id + ')">' + data[i].past + '</div>',

                        }

                        listado.push(objeto)

                    }




                    var columns = {
                        tools: 'Tools',
                        id: 'ID',
                        title: 'Title',
                        date: 'Date',
                        time: 'Time',
                        location: 'Location',
                        experts: 'Faculty',
                        description: 'Description',
                        media_file: 'Media File',
                        past: 'Past',
                    }



                    table = $('#root').tableSortable({
                        data: listado,
                        columns: columns,
                        searchField: '#searchField',
                        /*responsive: {
                            1100: {
                                columns: {
                                    formCode: 'Form Code',
                                    formName: 'Form Name',
                                },
                            },
                        },*/
                        rowsPerPage: 10,
                        pagination: true,
                        tableWillMount: function() {
                            //console.log('table will mount')
                        },
                        tableDidMount: function() {
                            //console.log('table did mount')
                        },
                        tableWillUpdate: function() {
                            //console.log('table will update')

                        },
                        tableDidUpdate: function() {
                            //console.log('table did update')
                            for (i = 0; i < total_filas; i++) {

                                if (data[i].activate == 1) {
                                    $(".tog" + data[i].id).click();
                                }
                                $(".tog" + data[i].id).attr('onclick', 'cambiarActivo(' + data[i].id + ')');
                                //$(".tog" + data[i].id).attr('onclick', 'cambiarActivo(' + data[i].id + ')');


                            }
                        },
                        tableWillUnmount: function() {
                            //console.log('table will unmount')
                        },
                        tableDidUnmount: function() {
                            //console.log('table did unmount')
                        },
                        onPaginationChange: function(nextPage, setPage) {
                            setPage(nextPage);
                        }
                    });

                    $('#changeRows').on('change', function() {
                        table.updateRowsPerPage(parseInt($(this).val(), 10));
                    })

                    $('#rerender').click(function() {
                        table.refresh(true);
                    })

                    $('#distory').click(function() {
                        table.distroy();
                    })

                    $('#refresh').click(function() {
                        table.refresh();
                    })

                    $('#setPage2').click(function() {
                        table.setPage(1);
                    })



                    //cambiar activate
                    for (i = 0; i < data.length; i++) {
                        if (data[i].activate == 1) {
                            $(".tog" + data[i].id).click();
                        }
                        $(".tog" + data[i].id).attr('onclick', 'cambiarActivo(' + data[i].id + ')');


                    }

                    $(".btn-group").addClass('cambiar_btn_pagination')

                }
            }
        });
    }


    function cargar_listado_country() {
        let total_filas = 0;

        $.ajax({
            type: "POST",
            url: "apis/events.php",
            data: {
                method: "get_all_country",
                country: $("#country").val()
            },
            success: function(data) {
                //$('#content').fadeIn(1000).html(data);

                if (data == "Token ERROR") {
                    alert("Sessione scaduta. Per favore esegui l'accesso di nuovo.");
                    document.location = "index.html";
                } else if (data == '') {
                    alert('There are no events')
                } else {
                    data = JSON.parse(data);
                    ////console.log(data)


                    total_filas = data.length;
                    $("#event_totals").html(total_filas);

                    let listado = [];

                    for (i = 0; i < data.length; i++) {

                        var experts = '';
                        for (j = 0; j < data[i].experts.length; j++) {
                            if ((j + 1) != data[i].experts.length) {
                                experts = experts + data[i].experts[j].name + ' ' + data[i].experts[j].surname + ', ';
                            } else {
                                experts = experts + data[i].experts[j].name + ' ' + data[i].experts[j].surname;
                            }
                        }
                        var id = parseInt(data[i].id);
                        var description_en = data[i].description_en.replace("<p>", '');
                        description_en = description_en.substr(0, 20) + '...';

                        var objeto = {
                            tools: '<div style="display:flex"><img src="img/duplicate.svg" style="cursor:pointer;" onclick="duplicate_event(' + data[i].id + ')"><img src="img/edit2.svg" style="cursor:pointer;margin-left:5px;margin-right:5px" onclick="update_event(' + data[i].id + ')"><img src="img/delete.svg" style="cursor:pointer" onclick="delete_event(' + data[i].id + ')"></div>',
                            id: id,
                            title: '<span style="cursor:pointer"  class="truncate" onclick="ver_event(\'' + data[i].title_en + '\',' + data[i].id + ')">' + data[i].title_en + '</div>',
                            date: '<span style="cursor:pointer" onclick="ver_event(\'' + data[i].start_date + '\',' + data[i].id + ')">' + data[i].start_date + '</div>',
                            time: '<span style="cursor:pointer" onclick="ver_event(\'' + data[i].start_time + '\',' + data[i].id + ')">' + data[i].start_time + '</div>',
                            location: '<span style="cursor:pointer"  class="truncate" onclick="ver_event(\'' + data[i].location + '\',' + data[i].id + ')">' + data[i].location + '</div>',
                            experts: '<span style="cursor:pointer"  class="truncate" onclick="ver_event(\'' + data[i].experts + '\',' + data[i].id + ')">' + experts + '</div>',
                            description: '<span style="cursor:pointer" onclick="ver_event(\'' + description_en + '\',' + data[i].id + ')">' + description_en + '</div>',
                            media_file: '<span style="cursor:pointer" class="truncate" onclick="ver_event(\'' + data[i].media_file + '\',' + data[i].id + ')">' + data[i].media_file + '</div>',
                            past: '<span style="cursor:pointer" onclick="ver_event(\'' + data[i].past + '\',' + data[i].id + ')">' + data[i].past + '</div>',

                        }

                        listado.push(objeto)

                    }




                    var columns = {
                        tools: 'Tools',
                        id: 'ID',
                        title: 'Title',
                        date: 'Date',
                        time: 'Time',
                        location: 'Location',
                        experts: 'Faculty',
                        description: 'Description',
                        media_file: 'Media File',
                        past: 'Past',
                    }



                    table = $('#root').tableSortable({
                        data: listado,
                        columns: columns,
                        searchField: '#searchField',
                        /*responsive: {
                            1100: {
                                columns: {
                                    formCode: 'Form Code',
                                    formName: 'Form Name',
                                },
                            },
                        },*/
                        rowsPerPage: 10,
                        pagination: true,
                        tableWillMount: function() {
                            //console.log('table will mount')
                        },
                        tableDidMount: function() {
                            //console.log('table did mount')
                        },
                        tableWillUpdate: function() {
                            //console.log('table will update')

                        },
                        tableDidUpdate: function() {
                            //console.log('table did update')
                            for (i = 0; i < total_filas; i++) {

                                if (data[i].activate == 1) {
                                    $(".tog" + data[i].id).click();
                                }
                                $(".tog" + data[i].id).attr('onclick', 'cambiarActivo(' + data[i].id + ')');
                                //$(".tog" + data[i].id).attr('onclick', 'cambiarActivo(' + data[i].id + ')');


                            }
                        },
                        tableWillUnmount: function() {
                            //console.log('table will unmount')
                        },
                        tableDidUnmount: function() {
                            //console.log('table did unmount')
                        },
                        onPaginationChange: function(nextPage, setPage) {
                            setPage(nextPage);
                        }
                    });

                    $('#changeRows').on('change', function() {
                        table.updateRowsPerPage(parseInt($(this).val(), 10));
                    })

                    $('#rerender').click(function() {
                        table.refresh(true);
                    })

                    $('#distory').click(function() {
                        table.distroy();
                    })

                    $('#refresh').click(function() {
                        table.refresh();
                    })

                    $('#setPage2').click(function() {
                        table.setPage(1);
                    })



                    //cambiar activate
                    for (i = 0; i < data.length; i++) {
                        if (data[i].activate == 1) {
                            $(".tog" + data[i].id).click();
                        }
                        $(".tog" + data[i].id).attr('onclick', 'cambiarActivo(' + data[i].id + ')');


                    }

                    $(".btn-group").addClass('cambiar_btn_pagination')

                }
            }
        });
    }


    function download() {
        window.open('apis/descarga_eventi.php', '_blank');
    }

</script>

<script>


</script>
