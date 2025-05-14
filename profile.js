//Cargamos cabcera
$("#header_page").empty();
$("#header_page").css("background-image", "linear-gradient(287deg, rgba(219, 186, 174, 0.31) 23.39%, rgba(134, 150, 176, 0.60) 50.77%, rgba(0, 47, 108, 0.60) 76.61%), url(img/header/profile.png)");
$("#header_page").append(`
    <div class="page_title" data-section="profile" data-value="title"></div>
`);

$(".sub_menu").empty();
$(".sub_menu").append(`
    <div class="sub_menu_left" style="width:91px;"></div>
    <img id="scroll_start" src="img/header/scroll_start.svg" style="position:relative;margin-right:-134px;display:none;"> 
    <div class="sub_menu_center">
        <div class="sub_menu_item" data-section="profile" data-value="personal_information" onClick="slide_to_section(this)"></div>
        <div class="sub_menu_item" data-section="profile" data-value="events" onClick="slide_to_section(this)"></div>        
        <div id="marketing_materials_menu" class="sub_menu_item" data-section="profile" data-value="marketing_materials" onClick="slide_to_section(this)"></div>
        <div class="sub_menu_item" data-section="profile" data-value="favourites" onClick="slide_to_section(this)"></div>      
    </div>
    <img id="scroll_end" src="img/header/scroll_end.svg" style="position:relative;margin-left:-135px;display:none;"> 
    <div class="sub_menu_item back_top" onclick="back_to_top()">
        <span data-section="profile" data-value="back_to_top"></span>
        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="8" viewBox="0 0 15 8" fill="none">
            <path d="M1 7.25L7.5 0.75L14 7.25" stroke="#002F6C" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </div>
`);

sub_menu_center_container = "";
sub_menu_center_inside = "";
setTimeout(() => {
    if ($(window).width() > 520) {
        sub_menu_center_container = $(".sub_menu_center").width();
        sub_menu_center_inside = 0;
        $(".sub_menu_center div").each(function () {
            sub_menu_center_inside = sub_menu_center_inside + $(this).width() + 24;
        });
        console.log(sub_menu_center_container);
        console.log(sub_menu_center_inside);

        if (sub_menu_center_container < sub_menu_center_inside) {
            //$(".sub_menu_center").css("background","url(img/header/scroll_end.svg) right no-repeat");
            $("#scroll_end").css("display", "block");
        }
    }

    $('html, body').animate({
        scrollTop: 0
    }, 0);

}, 1500);

//Asignamos section de idioma
$(".page_title").attr("data-section", "profile");
$(".page_title").attr("data-value", "title");


//Scroll to section selected
function slide_to_section(menu_item) {
    section = $(menu_item).data("value");

    if ($(window).width() > 520) {
        $('html, body').animate({
            scrollTop: $("#" + section).offset().top + 2
        }, 500);
    } else {
        $('html, body').animate({
            scrollTop: $("#" + section).offset().top - 145
        }, 1000);
    }
}

var scrollPos = 0;

//Sub menu fixed
window.onscroll = () => {
    scroll_page = $(document).scrollTop();
    header_bottom_position = $("#header_page").offset().top + $("#header_page").height();

    if ($(window).width() > 520) {
        if (scroll_page > header_bottom_position) {
            $(".sub_menu_container").css("position", "fixed");
            $(".sub_menu_container").next().css("padding-top", "146px");
        } else {
            $(".sub_menu_container").css("position", "relative");
            $(".sub_menu_container").next().css("padding-top", "80px");
        }

        personal_information = $("#personal_information").offset().top - 66;
        events = $("#events").offset().top - 66;
        if ($("#marketing_materials_menu").css("display") == "block") {
            marketing_materials = $("#marketing_materials").offset().top - 66;
        }
        favourites = $("#favourites").offset().top - 66;
    } else {
        personal_information = $("#personal_information").offset().top;
        events = $("#events").offset().top - 150;
        if ($("#marketing_materials_menu").css("display") == "block") {
            marketing_materials = $("#marketing_materials").offset().top - 150;
        }
        favourites = $("#favourites").offset().top - 150;
    }

    if (scroll_page < personal_information || scroll_page == 0) {
        $(".sub_menu_item").removeClass("selected");
        $(".sub_menu_center").scrollLeft(0);
    }
    if (scroll_page > personal_information && scroll_page < events) {
        if (sub_menu_center_container < sub_menu_center_inside) {
            //$(".sub_menu_center").css("background","url(img/header/scroll_end.svg) right no-repeat");
            $("#scroll_start").css("display", "none");
            $("#scroll_end").css("display", "block");
        }

        if ($(".sub_menu_item[data-value='personal_information']").hasClass("selected")) {

        } else {
            $(".sub_menu_item").removeClass("selected");
            $(".sub_menu_item[data-value='personal_information']").addClass("selected");
            $(".sub_menu_center").scrollLeft(0);
        }
    }
    if ($("#marketing_materials_menu").css("display") == "block") {
        if (scroll_page > events && scroll_page < marketing_materials) {
            if (sub_menu_center_container < sub_menu_center_inside) {
                //$(".sub_menu_center").css("background","url(img/header/scroll_end.svg) right no-repeat, url(img/header/scroll_start.svg) left no-repeat");
                $("#scroll_start").css("display", "block");
                $("#scroll_end").css("display", "block");
            }

            if ((document.body.getBoundingClientRect()).top > scrollPos) {
                if ($(".sub_menu_item[data-value='events']").hasClass("selected")) {

                } else {
                    $(".sub_menu_item").removeClass("selected");
                    $(".sub_menu_item[data-value='events']").addClass("selected");
                    //$(".sub_menu_center").scrollLeft($(".sub_menu_center").scrollLeft() - 200);
                }
            } else {
                if ($(".sub_menu_item[data-value='events']").hasClass("selected")) {

                } else {
                    $(".sub_menu_item").removeClass("selected");
                    $(".sub_menu_item[data-value='events']").addClass("selected");
                    $(".sub_menu_center").scrollLeft($(".sub_menu_center").scrollLeft() + 200);
                }
            }
        }
        if (scroll_page > marketing_materials && scroll_page < favourites) {
            if (sub_menu_center_container < sub_menu_center_inside) {
                //$(".sub_menu_center").css("background","url(img/header/scroll_end.svg) right no-repeat, url(img/header/scroll_start.svg) left no-repeat");
                $("#scroll_start").css("display", "block");
                $("#scroll_end").css("display", "block");
            }

            if ((document.body.getBoundingClientRect()).top > scrollPos) {
                if ($(".sub_menu_item[data-value='marketing_materials']").hasClass("selected")) {

                } else {
                    $(".sub_menu_item").removeClass("selected");
                    $(".sub_menu_item[data-value='marketing_materials']").addClass("selected");
                    //$(".sub_menu_center").scrollLeft($(".sub_menu_center").scrollLeft() - 200);
                }
            } else {
                if ($(".sub_menu_item[data-value='marketing_materials']").hasClass("selected")) {

                } else {
                    $(".sub_menu_item").removeClass("selected");
                    $(".sub_menu_item[data-value='marketing_materials']").addClass("selected");
                    $(".sub_menu_center").scrollLeft($(".sub_menu_center").scrollLeft() + 200);
                }
            }
        }
    } else {
        if (scroll_page > events && scroll_page < favourites) {
            if (sub_menu_center_container < sub_menu_center_inside) {
                //$(".sub_menu_center").css("background","url(img/header/scroll_end.svg) right no-repeat, url(img/header/scroll_start.svg) left no-repeat");
                $("#scroll_start").css("display", "block");
                $("#scroll_end").css("display", "block");
            }

            if ((document.body.getBoundingClientRect()).top > scrollPos) {
                if ($(".sub_menu_item[data-value='events']").hasClass("selected")) {

                } else {
                    $(".sub_menu_item").removeClass("selected");
                    $(".sub_menu_item[data-value='events']").addClass("selected");
                    $(".sub_menu_center").scrollLeft($(".sub_menu_center").scrollLeft() - 200);
                }
            } else {
                if ($(".sub_menu_item[data-value='events']").hasClass("selected")) {

                } else {
                    $(".sub_menu_item").removeClass("selected");
                    $(".sub_menu_item[data-value='events']").addClass("selected");
                    $(".sub_menu_center").scrollLeft($(".sub_menu_center").scrollLeft() + 200);
                }
            }
        }
    }
    if (scroll_page > favourites && scroll_page < favourites + $("#favourites").height()) {
        if (sub_menu_center_container < sub_menu_center_inside) {
            //$(".sub_menu_center").css("background","url(img/header/scroll_start.svg) left no-repeat");
            $("#scroll_start").css("display", "block");
            $("#scroll_end").css("display", "none");
        }

        if ((document.body.getBoundingClientRect()).top > scrollPos) {
            if ($(".sub_menu_item[data-value='favourites']").hasClass("selected")) {

            } else {
                $(".sub_menu_item").removeClass("selected");
                $(".sub_menu_item[data-value='favourites']").addClass("selected");
                //$(".sub_menu_center").scrollLeft($(".sub_menu_center").scrollLeft() - 200);
            }
        } else {
            if ($(".sub_menu_item[data-value='favourites']").hasClass("selected")) {

            } else {
                $(".sub_menu_item").removeClass("selected");
                $(".sub_menu_item[data-value='favourites']").addClass("selected");
                $(".sub_menu_center").scrollLeft($(".sub_menu_center").scrollLeft() + 200);
            }
        }
    }
    if (scroll_page > favourites + $("#favourites").height()) {
        $(".sub_menu_item").removeClass("selected");
    }

    scrollPos = (document.body.getBoundingClientRect()).top;
}

//Scroll to top
function back_to_top() {
    $(".sub_menu_item").removeClass("selected");
    if ($(window).width() > 520) {
        $("html, body").animate({
            scrollTop: 0
        }, 500);
    } else {
        $("html, body").animate({
            scrollTop: 0
        }, 1000);
    }
}

//Get user data
$.ajax({
    type: "POST",
    url: "apis/user.php",
    data: {
        method: "get_user",
        user_id: getCookie("user_id")
    },
    dataType: "html",
    beforeSend: function () {},
    error: function () {
        alert("Error de conexión.");
    },
    success: function (data) {
        //console.log(data);
        if (data == "Token ERROR") {
            // alert("Session expired. Please log in again.");
            // document.location = "index.html";
        } else {
            data = JSON.parse(data);
            let user = data;

            if (user.profile_image != null) {
                $(".profile_image_update").css('background-image', `linear-gradient(rgba(255, 255, 255, 0.5), rgba(255, 255, 255, 0.5)), url(users/user_${user.id}/${user.profile_image})`);
            } else {
                $(".profile_image_update").css('background-image', `linear-gradient(rgba(255, 255, 255, 0.5), rgba(255, 255, 255, 0.5)), url(img/default_profile_img.png)`);
            }

            $("#user_name").append(user.name + ' ' + user.surname);
            $("#user_level").append(user.level);

            $("#first_name").val(user.name);
            $("#last_name").val(user.surname);
            $("#medical_id_number").val(user.medical_id);
            $("#email").val(user.email);
            $("#clinic_name").val(user.clinic_name);
            $("#country").val(user.country);
            $("#region").val(user.city);
            $("#city").val(user.region);
            $("#ibsa_name").val(user.name_ibsa);
            $("#ibsa_email").val(user.email_ibsa);
            $("#ibsa_phone").val(user.phone_ibsa);
            $("#ibsa_whatsapp").val(user.whatsapp_ibsa);
            $("#ibsa_whatsapp").attr('onclick', 'enviarWhatsApp("' + user.whatsapp_ibsa + '")');
        }
    }
});


function enviarWhatsApp(numero) {
    let url = `https://wa.me/${numero}`;
    window.open(url, "_blank");
}


//Modificar foto profilo
$(".modifica_foto_profilo").click(function () {
    //console.log(foto_profilo);
    $("#img_profilo_inp").click();
});
$("#img_profilo_inp").on('change', function (e) {
    var archivos = document.getElementById('img_profilo_inp').files;
    var navegador = window.URL || window.webkitURL;

    var old_image = $(".profile_image_update").css("background-image");

    /* Recorrer los archivos */
    for (x = 0; x < archivos.length; x++) {
        /* Validar tamaño y tipo de archivo */
        var size = archivos[x].size;
        var type = archivos[x].type;
        var name = archivos[x].name;
        if (type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png') {
            $(".profile_image_update").css("background-image", old_image);
        } else {
            var objeto_url = navegador.createObjectURL(archivos[x]);
            $(".profile_image_update").css("background-image", "linear-gradient(rgba(255, 255, 255, 0.5), rgba(255, 255, 255, 0.5)), url(" + objeto_url + ")");

            Swal.fire({
                icon: "",
                title: "Do you want update your personal image?",
                showCancelButton: true,
                confirmButtonText: 'Confirm',
                cancelButtonText: `Cancel`,
            }).then((result) => {
                if (result.isConfirmed) {
                    var formData = new FormData($("#form_update_imgae")[0]);
                    formData.append('method', 'update_profile_picture');

                    $.ajax({
                        type: "POST",
                        method: "POST",
                        url: "apis/user.php",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        beforeSend: function () {},
                        error: function () {
                            console.log("error")
                        },
                        success: function (data) {
                            if (data == "Token ERROR") {
                                // alert("Sessione scaduta. Per favore esegui l'accesso di nuovo.");
                                // document.location = "index.html";
                            } else {
                                if (data == 'OK') {
                                    Swal.fire({
                                        icon: "success",
                                        title: 'You have successfully<br>modified your profile',
                                        showCancelButton: false,
                                        confirmButtonText: 'Confirm',
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            location.reload();
                                        }
                                    })
                                } else {
                                    Swal.fire({
                                        icon: "warning",
                                        title: "There was an error",
                                        showCancelButton: false,
                                        confirmButtonText: 'Confirm',
                                    }).then((result) => {
                                        if (result.isConfirmed) {}
                                    })
                                }
                            }
                        }
                    });
                } else {
                    $(".profile_image_update").css("background-image", old_image);
                }
            })

        }
    }
});

//Eventos del mes actual en adelante
load_events();

function load_events() {
    var mes_actual = (new Date().getMonth() + 1);
    mes_actual = (mes_actual < 10 ? '0' : '') + mes_actual;

    var current_date = new Date();
    current_date = current_date.getFullYear() + "-" + (current_date.getMonth() + 1) + "-" + current_date.getDate();

    $(".claendar_cards_events").css("display", "flex");
    $("#carousel_events_arrows").css("display", "flex");
    $(".upcoming_events").addClass("menu_item_active");
    $(".hr_upcoming_events").addClass("hr_active");

    $(".past_cards_events").css("display", "none");
    $("#carousel_past_events_arrows").css("display", "none");
    $(".past_events").removeClass("menu_item_active");
    $(".hr_past_events").removeClass("hr_active");

    $.ajax({
        type: "POST",
        url: "apis/events.php",
        data: {
            method: "get_all_events_month_next",
            current_date: current_date
        },
        dataType: "html",
        beforeSend: function () {},
        error: function () {
            alert("Error de conexión.");
        },
        success: function (data) {
            //console.log(data);
            if (data == "Token ERROR") {
                // alert("Sessione scaduta. Per favore esegui l'accesso di nuovo.");
                // document.location = "index.html";
            } else {
                if (data != "not_events") {
                    data = JSON.parse(data);
                    let events = data;
                    //console.log(events);

                    language = getCookie("language");
                    $("#events_cards").empty()
                    events.map((event) => {
                        //Date
                        var event_date = new Date(event.start_date).toLocaleDateString(language, {
                            day: "numeric",
                            month: "long"
                        });
                        event_date = uppercase(event_date);
                        //Start time
                        var event_start_time = new Date(event.start_date + " " + event.start_time);
                        var event_start_time = event_start_time.getHours() + ":" + (event_start_time.getMinutes() < 10 ? '0' : '') + event_start_time.getMinutes();
                        //End time
                        var event_end_time = new Date(event.start_date + " " + event.end_time);
                        var event_end_time = event_end_time.getHours() + ":" + (event_end_time.getMinutes() < 10 ? '0' : '') + event_end_time.getMinutes();


                        //Datos para añadir a calendario
                        var date_start = event.start_date;
                        var time_start = event.start_time;

                        //Google
                        var date_start_google = date_start.replace(/-/g, "");
                        var time_start_google = time_start.replace(/:/g, "");
                        var event_date_google = date_start_google + "T" + time_start_google;
                        var dates_google = event_date_google + "/" + event_date_google;

                        //Outlook
                        var event_start_outlook = date_start + "T" + time_start;
                        var event_end_outlook = date_start + "T" + time_start;

                        //Descriptcion de evento
                        var description = event.description;
                        description = description.replace(/"/g, "");

                        var event_card = `
                            <div class="evnet_card">
                                <div class="event_date_time_container">
                                    <div class="event_date_time">${event_date}</div>
                                    <div class="event_date_time">${event_start_time} - ${event_end_time}</div>
                                </div>

                                <div class="event_title">${event.title}</div> 
                                <div class="event_location">${event.location}</div> 
                                <div class="event_buttons">
                                    <div class="button" onclick="go_to_gdpr('${event.gdpr}')">GDPR</div>
                                    
                                    <div class="button add_calendar" onclick="open_add_calendar_options(this)">
                                        <img src="img/add_calendar.png">
                                        <div class="add_calendar_options">
                                            <a href="https://www.google.com/calendar/event?action=TEMPLATE&amp;dates=${dates_google}&amp;text=${event.title}&amp;details=${description}&amp;trp=false&amp;ctz=UTC+1&amp;" target="_blank">Google Calendar</a>
                                            <a href="webcal://ibsavaluance.it/event/${event.title}/?ical=1" target="_blank" rel="noopener noreferrer nofollow noindex">iCalendar</a>
                                            <a href="https://outlook.office.com/owa/?path=/calendar/action/compose&amp;rrv=addevent&amp;startdt=${event_start_outlook}&amp;enddt=${event_end_outlook}&amp;location=&amp;subject=${event.title}&amp;body=${description}" target="_blank">Outlook 365</a>
                                            <a href="https://outlook.live.com/owa/?path=/calendar/action/compose&amp;rrv=addevent&amp;startdt=${event_start_outlook}&amp;enddt=${event_end_outlook}&amp;location=&amp;subject=${event.title}&amp;body=${description}" target="_blank">Outlook Live</a>
                                        </div> 
                                    </div>                                
                                      
                                </div>
                            </div>`;

                        $("#events_cards").append(event_card);
                    });

                    // points = "";
                    // for(i=0; i < events.length / 2; i++){
                    //     if(i==0){
                    //         points = points + `<div class="point point_selected" onClick="move_scroll(${i},this,'events')"></div>`;
                    //     }else{
                    //         points = points + `<div class="point" onClick="move_scroll(${i},this,'events')"></div>`;
                    //     }

                    // }
                    // $("#events_carousel_points").empty();
                    // $("#events_carousel_points").append(points); 

                    $("#past_events_arrows").css("display", "none");

                    //Disabled arrows and points
                    if ($("#carousel_events").width() > $("#container_carousel_events").width()) {
                        $("#carousel_events_arrows").css("display", "flex");
                    } else {
                        $("#carousel_events_arrows").css("display", "none");
                    }
                } else {
                    $("#past_events_arrows").css("display", "none");
                    $("#carousel_events_arrows").css("display", "none");
                }
            }
        }
    });
    //reset carousel
    setTimeout(() => {
        $(".container_carousel").scrollLeft(0);
    }, 300);
    setTimeout(() => {
        $("#events_left_arrow").click();
    }, 400);
}

//Load past events
function load_past_events() {
    var mes_actual = (new Date().getMonth() + 1);
    mes_actual = (mes_actual < 10 ? '0' : '') + mes_actual;

    var current_date = new Date();
    current_date = current_date.getFullYear() + "-" + (current_date.getMonth() + 1) + "-" + current_date.getDate();

    $(".claendar_cards_events").css("display", "none");
    $("#carousel_events_arrows").css("display", "none");
    $(".upcoming_events").removeClass("menu_item_active");
    $(".hr_upcoming_events").removeClass("hr_active");

    $(".past_cards_events").css("display", "block");
    $("#carousel_past_events_arrows").css("display", "flex");
    $(".past_events").addClass("menu_item_active");
    $(".hr_past_events").addClass("hr_active");

    $.ajax({
        type: "POST",
        url: "apis/events.php",
        data: {
            method: "get_all_past_events_month",
            current_date: current_date
        },
        dataType: "html",
        beforeSend: function () {},
        error: function () {
            alert("Error de conexión.");
        },
        success: function (data) {
            //console.log(data);
            if (data == "Token ERROR") {
                // alert("Sessione scaduta. Per favore esegui l'accesso di nuovo.");
                // document.location = "index.html";
            } else {
                if (data != "not_events") {
                    data = JSON.parse(data);
                    let events = data;
                    //console.log(events);

                    language = getCookie("language");
                    $("#carousel_past_events").empty();
                    events.map((event) => {
                        //Date
                        var event_date = new Date(event.start_date).toLocaleDateString(language, {
                            day: "numeric",
                            month: "long"
                        });
                        event_date = uppercase(event_date);
                        //Start time
                        var event_start_time = new Date(event.start_date + " " + event.start_time);
                        var event_start_time = event_start_time.getHours() + ":" + (event_start_time.getMinutes() < 10 ? '0' : '') + event_start_time.getMinutes();
                        //End time
                        var event_end_time = new Date(event.start_date + " " + event.end_time);
                        var event_end_time = event_end_time.getHours() + ":" + (event_end_time.getMinutes() < 10 ? '0' : '') + event_end_time.getMinutes();


                        available = "disabled";
                        if (event.certificate_file != "") {
                            available = ""
                        }
                        var event_card = `
                            <div class="past_evnet_card">
                                <div class="event_title">${event.title}</div> 
                                <div class="event_location">${event_date}</div> 
                                <div class="event_location">${event.location}</div> 
                                <div class="event_buttons">
                                    <div class="button" onclick="go_to_survey('${event.survey_address}')">Survey</div>
                                    <div class="button ${available}" onclick="go_to_certificate(${event.id},'${event.certificate_file}')">Certificate</div>
                                </div>
                            </div>`;

                        $("#carousel_past_events").append(event_card);
                    });

                    // points = "";
                    // for(i=0; i < events.length / 2; i++){
                    //     if(i==0){
                    //         points = points + `<div class="point point_selected" onClick="move_scroll(${i},this,'events')"></div>`;
                    //     }else{
                    //         points = points + `<div class="point" onClick="move_scroll(${i},this,'events')"></div>`;
                    //     }

                    // }
                    // $("#past_events_carousel_points").empty();
                    // $("#past_events_carousel_points").append(points); 

                    //Disabled arrows and points                    
                    if ($("#carousel_past_events").width() > $("#container_carousel_past_events").width()) {
                        $("#past_events_arrows").css("display", "flex");
                    } else {
                        $("#past_events_arrows").css("display", "none");
                    }
                } else {
                    $("#past_events_arrows").css("display", "none");
                }
            }
        }
    });
    //reset carousel
    setTimeout(() => {
        $(".container_carousel").scrollLeft(0);
        $("#past_events_left_arrow").click();
    }, 1700);
}

document.addEventListener('DOMContentLoaded', () => {
  const titles = document.querySelectorAll('.event-title');
  
  titles.forEach(title => {
    title.addEventListener('click', () => {
      window.location.href = 'events.html';
    });
  });
});




//Go to events page
$("#discover_all_events").click(function () {
    document.location = "events.html";
});
$("#discover_all_events_mobile").click(function () {
    document.location = "events.html";
});

//Go to page gdpr
function go_to_gdpr(address) {
    if (address.indexOf("https") > -1 || address.indexOf("http") > -1) {
        window.open(address);
    } else {
        window.open("https://" + address);
    }
}

//Go to page survey
function go_to_survey(address) {
    if (address.indexOf("https") > -1 || address.indexOf("http") > -1) {
        window.open(address);
    } else {
        window.open("https://" + address);
    }
}

//Go to open certificate
function go_to_certificate(id_event, certificate_fie) {
    window.open("https://ibsamia.com/back/events/event_" + id_event + "/" + certificate_fie);
}

//Open options add to calendar
function open_add_calendar_options(button) {

    if ($(button).find("div").css("display") == "none") {

        $(button).css("border-start-end-radius", "inherit");
        $(button).css("border-start-start-radius", "inherit");

        $(button).find("div").fadeIn();
        $(button).find("div").css("display", "flex");
    } else {

        $(button).css("border-start-end-radius", "10px");
        $(button).css("border-start-start-radius", "10px");

        $(button).find("div").css("display", "none");
    }
}

//Load marketing materials and buttons filter
$.ajax({
    type: "POST",
    url: "apis/user.php",
    data: {
        method: "get_user",
        user_id: getCookie("user_id")
    },
    dataType: "html",
    beforeSend: function () {},
    error: function () {
        alert("Error de conexión.");
    },
    success: function (data) {
        //console.log(data);
        if (data == "Token ERROR") {
            // alert("Session expired. Please log in again.");
            // document.location = "index.html";
        } else {
            data = JSON.parse(data);
            let user = data;

            if (user.role != "physician") {
                get_marketing_materials("mktg material", product_line);
                $("#marketing_materials h3").attr("data-value", "trining_materials_title");
            } else {
                get_marketing_materials("mktg material", product_line);
                // $("#marketing_materials_menu").css('display', `none`);
                // $("#marketing_materials").css('display', `none`);
                // $("#favourites").css("background-color","inherit");
            }
        }
    }
});
let product_line = new Array;
product_line.push("all");


$("#all_materials").click(function () {
    $("#aliaxin").removeClass("active");
    $("#profhilo").removeClass("active");
    $("#viscoderm").removeClass("active");
    product_line = [];

    if (!$("#all_materials").hasClass("active")) {
        $("#all_materials").addClass("active");
        product_line.push("all");

        get_marketing_materials("mktg material", product_line);
    }

});
$("#aliaxin").click(function () {
    $("#all_materials").removeClass("active");
    if ($("#aliaxin").hasClass("active")) {
        $("#aliaxin").removeClass("active");
        pos = product_line.indexOf("aliaxin");
        product_line.splice(pos, 1);
    } else {
        pos = product_line.indexOf("all");
        if (pos > -1) {
            product_line.splice(pos, 1);
        }
        $("#aliaxin").addClass("active");
        product_line.push("aliaxin");
    }

    if (!$(".bottom_material_filter").hasClass("active")) {
        $("#all_materials").click();
    } else {
        get_marketing_materials("mktg material", product_line);
    }
});
$("#profhilo").click(function () {
    $("#all_materials").removeClass("active");
    if ($("#profhilo").hasClass("active")) {
        $("#profhilo").removeClass("active");
        pos = product_line.indexOf("profhilo");
        product_line.splice(pos, 1);
    } else {
        pos = product_line.indexOf("all");
        if (pos > -1) {
            product_line.splice(pos, 1);
        }
        $("#profhilo").addClass("active");
        product_line.push("profhilo");

    }

    if (!$(".bottom_material_filter").hasClass("active")) {
        $("#all_materials").click();
    } else {
        get_marketing_materials("mktg material", product_line);
    }
});
$("#viscoderm").click(function () {
    $("#all_materials").removeClass("active");
    if ($("#viscoderm").hasClass("active")) {
        $("#viscoderm").removeClass("active");
        pos = product_line.indexOf("viscoderm");
        product_line.splice(pos, 1);
    } else {
        pos = product_line.indexOf("all");
        if (pos > -1) {
            product_line.splice(pos, 1);
        }
        $("#viscoderm").addClass("active");
        product_line.push("viscoderm");
    }

    if (!$(".bottom_material_filter").hasClass("active")) {
        $("#all_materials").click();
    } else {
        get_marketing_materials("mktg material", product_line);
    }
});

//Load carousels favourite content
get_favourites_contents();
// get_favourites_contents_documents('document');
// get_favourites_contents_videos('video');

function get_favourites_contents() {
    $.ajax({
        type: "POST",
        url: "apis/content.php",
        data: {
            method: "get_favourites_contents"
        },
        dataType: "html",
        beforeSend: function () {},
        error: function () {
            alert("Error de conexión.");
        },
        success: function (data) {
            if (data == "Token ERROR") {
                // alert("Session expired. Please log in again.");
                // document.location = "index.html";
            } else {
                if (data == "No content") {
                    $("#carousel_favourite").empty();
                    $("#carousel_favourite").append("<div class='banner_no_contents'>You don’t have favourite content yet<div>");
                    $("#container_carousel_favourite").css("max-width", $(".container").css("max-width"));
                    $("#container_carousel_favourite").css("margin", "20px auto 40px auto");
                } else {
                    let contents = JSON.parse(data);
                    console.log(contents)

                    $("#carousel_favourite").empty();

                    //Hidden cards left carousel
                    margin_left = $(".container").css("margin-left");
                    margin_left = Math.trunc(margin_left.replace("px", ""));
                    number_extra_cards = Math.trunc(margin_left / 286);

                    margin_left_extra = number_extra_cards * 286;
                    card_rest = (margin_left - margin_left_extra);
                    $("#container_carousel_favourite").css("margin-left", card_rest);

                    for (i = 0; i < number_extra_cards; i++) {
                        $("#carousel_favourite").append(`<div class="card_hidden"></div>`);
                    }

                    contents.map((content) => {
                        //Etiqueta propaedeutic
                        propaedeutic = "";
                        if (content.propaedeutic == "yes") {
                            propaedeutic = "<div class='propaedeutic'>Propaedeutic</div>"
                        }

                        //Seleccionado favorito
                        favorite = "f_on";

                        //Etiqueta linea de producto o producto
                        card_tag_display = "style=display:block";
                        card_tag = "";
                        switch (content.product_line) {
                            case "viscoderm":
                                card_tag = "Viscoderm<sup>&reg;</sup>"
                                break
                            case "profhilo":
                                card_tag = "Profhilo<sup>&reg;</sup>"
                                break
                            case "profhilo_body":
                                card_tag = "Profhilo<sup>&reg;</sup> Body"
                                break
                            case "profhilo_structura":
                                card_tag = "Profhilo<sup>&reg;</sup> Structura"
                                break
                            case "aliaxin":
                                card_tag = "Aliaxin<sup>&reg;</sup>"
                                break
                            case "":
                                card_tag_display = "style=display:none";
                                break
                        }

                        switch (content.product_name) {
                            case "aliaxin_fl":
                                card_tag = "Aliaxin <sup>&reg;</sup> FL"
                                break
                            case "aliaxin_sr":
                                card_tag = "Aliaxin<sup>&reg;</sup> SR"
                                break
                            case "aliaxin_gp":
                                card_tag = "Aliaxin<sup>&reg;</sup> GP"
                                break
                            case "aliaxin_fv":
                                card_tag = "Aliaxin<sup>&reg;</sup> FV"
                                break
                            case "aliaxin_ev":
                                card_tag = "Aliaxin<sup>&reg;</sup> EV"
                                break
                            case "aliaxin_sv":
                                card_tag = "Aliaxin<sup>&reg;</sup> SV"
                                break
                            case "viscoderm_0.8":
                                card_tag = "Viscoderm<sup>&reg;</sup> 0.8%"
                                break
                            case "viscoderm_1.6":
                                card_tag = "Viscoderm<sup>&reg;</sup> 1.6 Trio"
                                break
                            case "viscoderm_2.0":
                                card_tag = "Viscoderm<sup>&reg;</sup> 2.0%"
                                break
                            case "viscoderm_hydrobooster":
                                card_tag = "Viscoderm<sup>&reg;</sup> Hydrobooster"
                                break
                            case "viscoderm_skinko":
                                card_tag = "Viscoderm<sup>&reg;</sup> Skinkò/Skinkò e"
                                break
                            case "profhilo_face_neck":
                                card_tag = "Profhilo<sup>&reg;</sup> Face & Neck"
                                break
                            case "profhilo_body_kit":
                                card_tag = "Profhilo<sup>&reg;</sup> Body"
                                break
                            case "profhilo_haenkenium":
                                card_tag = "Profhilo<sup>&reg;</sup> Haenkenium"
                                break
                            case "profhilo_structura":
                                card_tag = "Profhilo<sup>&reg;</sup> Structura"
                                break
                        }

                        //Content title
                        content_title = content.title;
                        content_title = content_title.replace("®", "<sup>®</sup>");

                        //Experts names
                        experts_lines = "";
                        experts = content.experts;
                        if (experts != "not_experts") {
                            experts.map((expert) => {
                                experts_lines = experts_lines + `<p style="cursor:pointer;" onclick="open_expert_popup(${expert.id})">${expert.title} ${expert.name} ${expert.surname}</p>`;
                            });
                        }

                        if (content.type == "document") {
                            //Label boton segun idioma
                            switch (getCookie("language")) {
                                case "it":
                                    button_lavel = "Open now"
                                    break
                                case "fr":
                                    button_lavel = "Open now"
                                    break
                                case "es":
                                    button_lavel = "Open now"
                                    break
                                default:
                                    button_lavel = "Open now"
                                    break
                            }
                            if (content.category == "library") {
                                carousel = `
                                <div class="card_document">  
                                    <h4>${content_title}</h4>
                                    <div class="favorite_product">
                                        <div class="favorite ${favorite}" onClick="add_favorites(${content.id},this)"></div>
                                        <div class="card_tag" ${card_tag_display}>${card_tag}</div>
                                    </div>
                                    <div class="container_card_button">
                                        <div class="button" onclick="go_to_document(${content.id},'${content.file}')">${button_lavel}</div>
                                    </div>
                                </div> `;
                            } else {
                                carousel = `
                                <div class="card">
                                    <div class="card_img" style="background-image: url('back/contents/content_${content.id}/${content.image}');">${propaedeutic}</div>                                
                                    <div class="favorite_product">
                                        <div class="favorite ${favorite}" onClick="add_favorites(${content.id},this)"></div>
                                        <div class="card_tag" ${card_tag_display}>${card_tag}</div>
                                    </div>
                                    <h4>${content_title}</h4>
                                    <div class="card_info">${experts_lines}</div>
                                    <div class="container_card_button">
                                        <div class="button" onclick="go_to_document(${content.id},'${content.file}')">${button_lavel}</div>
                                    </div>
                                </div> `;
                            }

                        } else if (content.type == "video") {
                            //Label boton segun estado e idioma
                            started = content.started;
                            switch (getCookie("language")) {
                                case "it":
                                    if (started == 0) {
                                        button_lavel = "Start watching"
                                    } else if (started == 1) {
                                        button_lavel = "Continue watching"
                                    } else if (started == 2) {
                                        button_lavel = "Watch again"
                                    }
                                    break
                                case "fr":
                                    if (started == 0) {
                                        button_lavel = "Start watching"
                                    } else if (started == 1) {
                                        button_lavel = "Continue watching"
                                    } else if (started == 2) {
                                        button_lavel = "Watch again"
                                    }
                                    break
                                case "es":
                                    if (started == 0) {
                                        button_lavel = "Start watching"
                                    } else if (started == 1) {
                                        button_lavel = "Continue watching"
                                    } else if (started == 2) {
                                        button_lavel = "Watch again"
                                    }
                                    break
                                default:
                                    if (started == 0) {
                                        button_lavel = "Start watching"
                                    } else if (started == 1) {
                                        button_lavel = "Continue watching"
                                    } else if (started == 2) {
                                        button_lavel = "Watch again"
                                    }
                                    break
                            }

                            carousel = `
                                <div class="card">   
                                    <div class="card_img" style="background-image: url('back/contents/content_${content.id}/${content.image}');">${propaedeutic}</div>  
                                    <div class="favorite_product">
                                        <div class="favorite ${favorite}" onClick="add_favorites(${content.id},this)"></div>
                                        <div class="card_tag" ${card_tag_display}>${card_tag}</div>
                                    </div>
                                    <h4>${content_title}</h4>
                                    <div class="card_info">
                                        ${content.description}                      
                                    </div>
                                    <div class="container_card_button">
                                        <div class="button" data-section="home" data-value="button_card_start" onclick="go_to_content(${content.id})">${button_lavel}</div>
                                    </div>
                                </div>`;
                        }

                        $("#carousel_favourite").append(carousel);

                    });
                }

                //Disabled arrows and points
                if ($("#carousel_favourite").width() < $("#container_carousel_favourite").width()) {
                    $("#favourite_arrows").css("display", "none");
                } else {
                    //Hidden cards right carousel
                    margin_right = $(".container").css("margin-right");
                    margin_right = Math.trunc(margin_right.replace("px", ""));
                    number_extra_cards = Math.trunc(margin_right / 286);
                    for (i = 0; i < number_extra_cards; i++) {
                        $("#carousel_favourite").append(`<div class="card_hidden"></div>`);
                    }

                    margin_right_extra = number_extra_cards * 286;
                    card_rest = margin_right - margin_right_extra;
                    $("#carousel_favourite").append(`<div class="card_hidden" style="width:${card_rest}px !important"></div>`);
                }
                if ($("#carousel_favourite_video").width() < $("#container_carousel_favourite_video").width()) {
                    $("#favourite_video_arrows").css("display", "none");
                } else {
                    //Hidden cards right carousel
                    margin_right = $(".container").css("margin-right");
                    margin_right = Math.trunc(margin_right.replace("px", ""));
                    number_extra_cards = Math.trunc(margin_right / 286);
                    for (i = 0; i < number_extra_cards; i++) {
                        $("#carousel_favourite_video").append(`<div class="card_hidden"></div>`);
                    }

                    margin_right_extra = number_extra_cards * 286;
                    card_rest = margin_right - margin_right_extra;
                    $("#carousel_favourite_video").append(`<div class="card_hidden" style="width:${card_rest}px !important"></div>`);
                }
            }
        }
    });
    //reset carousel
    setTimeout(() => {
        $(".container_carousel").scrollLeft(0);
    }, 500);
}

function get_favourites_contents_documents(type) {
    $.ajax({
        type: "POST",
        url: "apis/content.php",
        data: {
            method: "get_favourites_contents",
            type: type
        },
        dataType: "html",
        beforeSend: function () {},
        error: function () {
            alert("Error de conexión.");
        },
        success: function (data) {
            if (data == "Token ERROR") {
                // alert("Session expired. Please log in again.");
                // document.location = "index.html";
            } else {
                if (data == "No content") {
                    $("#carousel_favourite_document").empty();
                    // $("#carousel_favourite_document").append("<h5>No content<h5>");
                    $("#carousel_favourite_document").append("<div class='banner_no_contents'>You don’t have favourite content yet<div>");
                    $("#container_carousel_favourite_document").css("max-width", $(".container").css("max-width"));
                    $("#container_carousel_favourite_document").css("margin", "20px auto 40px auto");
                } else {
                    data = JSON.parse(data);
                    let contents = data;

                    $("#carousel_favourite_document").empty();

                    //Hidden cards left carousel
                    margin_left = $(".container").css("margin-left");
                    margin_left = Math.trunc(margin_left.replace("px", ""));
                    number_extra_cards = Math.trunc(margin_left / 286);

                    margin_left_extra = number_extra_cards * 286;
                    card_rest = (margin_left - margin_left_extra);
                    $("#container_carousel_favourite_document").css("margin-left", card_rest);

                    for (i = 0; i < number_extra_cards; i++) {
                        $("#carousel_favourite_document").append(`<div class="card_hidden"></div>`);
                    }

                    contents.map((content) => {
                        //Etiqueta propaedeutic
                        propaedeutic = "";
                        if (content.propaedeutic == "yes") {
                            propaedeutic = "<div class='propaedeutic'>Propaedeutic</div>"
                        }

                        //Seleccionado favorito
                        favorite = "f_on";

                        //Etiqueta del product name
                        product_name_display = "style=display:block";
                        product_name = "";
                        switch (content.product_name) {
                            case "aliaxin_fl":
                                product_name = "Aliaxin <sup>&reg;</sup> FL"
                                break
                            case "aliaxin_sr":
                                product_name = "Aliaxin <sup>&reg;</sup> SR"
                                break
                            case "aliaxin_gp":
                                product_name = "Aliaxin <sup>&reg;</sup> GP"
                                break
                            case "aliaxin_fv":
                                product_name = "Aliaxin <sup>&reg;</sup> FV"
                                break
                            case "aliaxin_ev":
                                product_name = "Aliaxin <sup>&reg;</sup> EV"
                                break
                            case "aliaxin_sv":
                                product_name = "Aliaxin <sup>&reg;</sup> SV"
                                break
                            case "viscoderm_08":
                                product_name = "Viscoderm <sup>&reg;</sup> 0.8"
                                break
                            case "viscoderm_16":
                                product_name = "Viscoderm <sup>&reg;</sup> 1.6"
                                break
                            case "viscoderm_20":
                                product_name = "Viscoderm <sup>&reg;</sup> 2.0"
                                break
                            case "viscoderm_hydrobooster":
                                product_name = "Viscoderm <sup>&reg;</sup> HYDROBOOSTER"
                                break
                            case "viscoderm_skinko_e":
                                product_name = "Viscoderm <sup>&reg;</sup> SKINKO"
                                break
                            case "profhilo_face_neck":
                                product_name = "Profhilo <sup>&reg;</sup> FACE & NECK"
                                break
                            case "profhilo_body_kit":
                                product_name = "Profhilo <sup>&reg;</sup> BODY"
                                break
                            case "profhilo_haenkenium":
                                product_name = "Profhilo <sup>&reg;</sup> HAENKENUIM"
                                break
                            case "profhilo_structura":
                                product_name = "Profhilo <sup>&reg;</sup> Strusctura"
                                break
                            case "":
                                product_name_display = "style=display:none";
                                break
                        }

                        //Experts names
                        experts_lines = "";
                        experts = content.experts;
                        if (experts != "not_experts") {
                            experts.map((expert) => {
                                experts_lines = experts_lines + `<p style="cursor:pointer;" onclick="open_expert_popup(${expert.id})">${expert.title} ${expert.name} ${expert.surname}</p>`;
                            });
                        }

                        //Label boton segun idioma
                        switch (getCookie("language")) {
                            case "it":
                                button_lavel = "Preview"
                                break
                            case "fr":
                                button_lavel = "Preview"
                                break
                            case "es":
                                button_lavel = "Preview"
                                break
                            default:
                                button_lavel = "Preview"
                                break
                        }

                        carousel_document = `
                            <div class="card">
                                <div class="card_img" style="background-image: url('back/contents/content_${content.id}/${content.image}');">${propaedeutic}</div>                                
                                <div class="favorite_product">
                                    <div class="favorite ${favorite}" onClick="add_favorites(${content.id},this)"></div>
                                    <div class="product_name" ${product_name_display}>${product_name}</div>
                                </div>
                                <h4>${content.title}</h4>
                                <div class="card_info">${experts_lines}</div>
                                <div class="container_card_button">
                                    <div class="button" onclick="go_to_document(${content.id},'${content.file}')">${button_lavel}</div>
                                </div>
                            </div> `

                        $("#carousel_favourite_document").append(carousel_document);

                    });
                }

                //Disabled arrows and points
                if ($("#carousel_favourite_document").width() < $("#container_carousel_favourite_document").width()) {
                    $("#favourite_document_arrows").css("display", "none");
                } else {
                    //Hidden cards right carousel
                    margin_right = $(".container").css("margin-right");
                    margin_right = Math.trunc(margin_right.replace("px", ""));
                    number_extra_cards = Math.trunc(margin_right / 286);
                    for (i = 0; i < number_extra_cards; i++) {
                        $("#carousel_favourite_document").append(`<div class="card_hidden"></div>`);
                    }

                    margin_right_extra = number_extra_cards * 286;
                    card_rest = margin_right - margin_right_extra;
                    $("#carousel_favourite_document").append(`<div class="card_hidden" style="width:${card_rest}px !important"></div>`);
                }
                if ($("#carousel_favourite_video").width() < $("#container_carousel_favourite_video").width()) {
                    $("#favourite_video_arrows").css("display", "none");
                } else {
                    //Hidden cards right carousel
                    margin_right = $(".container").css("margin-right");
                    margin_right = Math.trunc(margin_right.replace("px", ""));
                    number_extra_cards = Math.trunc(margin_right / 286);
                    for (i = 0; i < number_extra_cards; i++) {
                        $("#carousel_favourite_video").append(`<div class="card_hidden"></div>`);
                    }

                    margin_right_extra = number_extra_cards * 286;
                    card_rest = margin_right - margin_right_extra;
                    $("#carousel_favourite_video").append(`<div class="card_hidden" style="width:${card_rest}px !important"></div>`);
                }
            }
        }
    });
    //reset carousel
    setTimeout(() => {
        $(".container_carousel").scrollLeft(0);
    }, 500);
}

function get_favourites_contents_videos(type) {
    $.ajax({
        type: "POST",
        url: "apis/content.php",
        data: {
            method: "get_favourites_contents",
            type: type
        },
        dataType: "html",
        beforeSend: function () {},
        error: function () {
            alert("Error de conexión.");
        },
        success: function (data) {
            if (data == "Token ERROR") {
                // alert("Session expired. Please log in again.");
                // document.location = "index.html";
            } else {
                if (data == "No content") {
                    $("#carousel_favourite_video").empty();
                    // $("#carousel_favourite_video").append("<h5>No content<h5>");
                    $("#carousel_favourite_video").append("<div class='banner_no_contents'>You don’t have favourite content yet<div>");
                    $("#container_carousel_favourite_video").css("max-width", $(".container").css("max-width"));
                    $("#container_carousel_favourite_video").css("margin", "20px auto 40px auto");
                } else {
                    data = JSON.parse(data);
                    let contents = data;

                    $("#carousel_favourite_video").empty();


                    //Hidden cards left carousel
                    margin_left = $(".container").css("margin-left");
                    margin_left = Math.trunc(margin_left.replace("px", ""));
                    number_extra_cards = Math.trunc(margin_left / 286);

                    margin_left_extra = number_extra_cards * 286;
                    card_rest = (margin_left - margin_left_extra);
                    $("#container_carousel_favourite_video").css("margin-left", card_rest);

                    for (i = 0; i < number_extra_cards; i++) {
                        $("#carousel_favourite_video").append(`<div class="card_hidden"></div>`);
                    }

                    contents.map((content) => {
                        //Seleccionado favorito
                        favorite = "f_on";

                        //Etiqueta del product name
                        product_name_display = "style=display:block";
                        product_name = "";
                        switch (content.product_name) {
                            case "aliaxin_fl":
                                product_name = "Aliaxin <sup>&reg;</sup> FL"
                                break
                            case "aliaxin_sr":
                                product_name = "Aliaxin <sup>&reg;</sup> SR"
                                break
                            case "aliaxin_gp":
                                product_name = "Aliaxin <sup>&reg;</sup> GP"
                                break
                            case "aliaxin_fv":
                                product_name = "Aliaxin <sup>&reg;</sup> FV"
                                break
                            case "aliaxin_ev":
                                product_name = "Aliaxin <sup>&reg;</sup> EV"
                                break
                            case "aliaxin_sv":
                                product_name = "Aliaxin <sup>&reg;</sup> SV"
                                break
                            case "viscoderm_08":
                                product_name = "Viscoderm <sup>&reg;</sup> 0.8"
                                break
                            case "viscoderm_16":
                                product_name = "Viscoderm <sup>&reg;</sup> 1.6"
                                break
                            case "viscoderm_20":
                                product_name = "Viscoderm <sup>&reg;</sup> 2.0"
                                break
                            case "viscoderm_hydrobooster":
                                product_name = "Viscoderm <sup>&reg;</sup> HYDROBOOSTER"
                                break
                            case "viscoderm_skinko_e":
                                product_name = "Viscoderm <sup>&reg;</sup> SKINKO"
                                break
                            case "profhilo_face_neck":
                                product_name = "Profhilo <sup>&reg;</sup> FACE & NECK"
                                break
                            case "profhilo_body_kit":
                                product_name = "Profhilo <sup>&reg;</sup> BODY"
                                break
                            case "profhilo_haenkenium":
                                product_name = "Profhilo <sup>&reg;</sup> HAENKENUIM"
                                break
                            case "profhilo_structura":
                                product_name = "Profhilo <sup>&reg;</sup> Strusctura"
                                break
                            case "":
                                product_name_display = "style=display:none";
                                break
                        }

                        //Etiqueta propaedeutic
                        propaedeutic = "";
                        if (content.propaedeutic == "yes") {
                            propaedeutic = "<div class='propaedeutic'>Propaedeutic</div>"
                        }

                        //Experts names
                        experts_lines = "";
                        experts = content.experts;
                        if (experts != "not_experts") {
                            experts.map((expert) => {
                                experts_lines = experts_lines + `<p style="cursor:pointer;" onclick="open_expert_popup(${expert.id})">${expert.title} ${expert.name} ${expert.surname}</p>`;
                            });
                        }

                        //Label boton segun estado e idioma
                        started = content.started;
                        switch (getCookie("language")) {
                            case "it":
                                if (started == 0) {
                                    button_lavel = "Start watching"
                                } else if (started == 1) {
                                    button_lavel = "Continue watching"
                                } else if (started == 2) {
                                    button_lavel = "Watch again"
                                }
                                break
                            case "fr":
                                if (started == 0) {
                                    button_lavel = "Start watching"
                                } else if (started == 1) {
                                    button_lavel = "Continue watching"
                                } else if (started == 2) {
                                    button_lavel = "Watch again"
                                }
                                break
                            case "es":
                                if (started == 0) {
                                    button_lavel = "Start watching"
                                } else if (started == 1) {
                                    button_lavel = "Continue watching"
                                } else if (started == 2) {
                                    button_lavel = "Watch again"
                                }
                                break
                            default:
                                if (started == 0) {
                                    button_lavel = "Start watching"
                                } else if (started == 1) {
                                    button_lavel = "Continue watching"
                                } else if (started == 2) {
                                    button_lavel = "Watch again"
                                }
                                break
                        }

                        carousel_video = `
                            <div class="card">   
                                <div class="card_img" style="background-image: url('back/contents/content_${content.id}/${content.image}');">${propaedeutic}</div>  
                                <div class="favorite_product">
                                    <div class="favorite ${favorite}" onClick="add_favorites(${content.id},this)"></div>
                                    <div class="product_name" ${product_name_display}>${product_name}</div>
                                </div>
                                <h4>
                                    ${content.title}
                                </h4>
                                <div class="card_info">
                                    ${content.description}                      
                                </div>
                                <div class="container_card_button">
                                    <div class="button" data-section="home" data-value="button_card_start" onclick="go_to_content(${content.id})">${button_lavel}</div>
                                </div>
                            </div>
                        `;

                        $("#carousel_favourite_video").append(carousel_video);
                    });
                }

                //Disabled arrows and points
                if ($("#carousel_favourite_document").width() < $("#container_carousel_favourite_document").width()) {
                    $("#favourite_document_arrows").css("display", "none");
                } else {
                    //Hidden cards right carousel
                    margin_right = $(".container").css("margin-right");
                    margin_right = Math.trunc(margin_right.replace("px", ""));
                    number_extra_cards = Math.trunc(margin_right / 286);
                    for (i = 0; i < number_extra_cards; i++) {
                        $("#carousel_favourite_document").append(`<div class="card_hidden"></div>`);
                    }

                    margin_right_extra = number_extra_cards * 286;
                    card_rest = margin_right - margin_right_extra;
                    $("#carousel_favourite_document").append(`<div class="card_hidden" style="width:${card_rest}px !important"></div>`);
                }
                if ($("#carousel_favourite_video").width() < $("#container_carousel_favourite_video").width()) {
                    $("#favourite_video_arrows").css("display", "none");
                } else {
                    //Hidden cards right carousel
                    margin_right = $(".container").css("margin-right");
                    margin_right = Math.trunc(margin_right.replace("px", ""));
                    number_extra_cards = Math.trunc(margin_right / 286);
                    for (i = 0; i < number_extra_cards; i++) {
                        $("#carousel_favourite_video").append(`<div class="card_hidden"></div>`);
                    }

                    margin_right_extra = number_extra_cards * 286;
                    card_rest = margin_right - margin_right_extra;
                    $("#carousel_favourite_video").append(`<div class="card_hidden" style="width:${card_rest}px !important"></div>`);
                }
            }
        }
    });
    //reset carousel
    setTimeout(() => {
        $(".container_carousel").scrollLeft(0);
    }, 500);
}


//Loads users graphics 
if ($(window).width() > 520) {
    var radius_grafic = '43';
    var font_grafic = '400 24px Montserrat';
} else {
    var radius_grafic = '33';
    var font_grafic = '400 18px Montserrat';
}

//Variables gradient graficas
var gradiant_width = $(".grafic").width() / 2;

//Anatomy charts data
$.ajax({
    type: "POST",
    url: "apis/content.php",
    data: {
        method: "get_chart",
        user_id: getCookie("user_id"),
        category: "anatomy"
    },
    dataType: "html",
    beforeSend: function () {},
    error: function () {
        alert("Error de conexión.");
    },
    success: function (data) {
        //console.log(data);
        if (data == "Token ERROR") {
            // alert("Session expired. Please log in again.");
            // document.location = "index.html";
        } else {
            //var anatomy_porcentage = data;
            user_contents_data = JSON.parse(data);
            //console.log(user_contents_data);

            var anatomy_porc_level1 = user_contents_data.anatomy_perc_1;
            var anatomy_porc_rest_level1 = 100 - anatomy_porc_level1;
            var anatomy_porc_level2 = user_contents_data.anatomy_perc_2;
            var anatomy_porc_rest_level2 = 100 - anatomy_porc_level2;
            var anatomy_porc_level3 = user_contents_data.anatomy_perc_3;
            var anatomy_porc_rest_level3 = 100 - anatomy_porc_level3;

            var centerText_chart = {
                id: 'centerText_chart',
                afterDatasetsDraw(chart, args, pluginOptions) {
                    const {
                        ctx,
                        data
                    } = chart;

                    //const text = data.datasets[data.labels[0]];
                    const text = anatomy_porc_level1 + "%";

                    ctx.save();
                    const x = chart.getDatasetMeta(0).data[0].x;
                    const y = chart.getDatasetMeta(0).data[0].y;
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle'
                    ctx.font = font_grafic;
                    ctx.fillStyle = '#002F6C';

                    ctx.fillText(text, x, y);
                }
            }
            var anatomy_chart_level1 = document.getElementById("anatomy_chart_level1").getContext("2d");

            gradientSegment = anatomy_chart_level1.createConicGradient(11, gradiant_width, gradiant_width, 0);
            gradientSegment.addColorStop(0, '#8696B0');
            gradientSegment.addColorStop(1, '#002F6C');

            window.grafica = new Chart(anatomy_chart_level1, {
                type: 'doughnut',
                data: {
                    labels: ['', '', '', ''],
                    datasets: [{
                        data: [anatomy_porc_level1, anatomy_porc_rest_level1],
                        backgroundColor: [gradientSegment, '#FFECE5'],
                        cutout: radius_grafic
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'none',
                        },
                        title: {
                            display: false,
                            text: ''
                        },
                    }
                },
                plugins: [centerText_chart]
            });

            centerText_chart = {
                id: 'centerText_chart',
                afterDatasetsDraw(chart, args, pluginOptions) {
                    const {
                        ctx,
                        data
                    } = chart;

                    //const text = data.datasets[data.labels[0]];
                    const text = anatomy_porc_level2 + "%";

                    ctx.save();
                    const x = chart.getDatasetMeta(0).data[0].x;
                    const y = chart.getDatasetMeta(0).data[0].y;
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle'
                    ctx.font = font_grafic;
                    ctx.fillStyle = '#002F6C';

                    ctx.fillText(text, x, y);
                }
            }
            var anatomy_chart_level2 = document.getElementById("anatomy_chart_level2").getContext("2d");
            gradientSegment = anatomy_chart_level2.createConicGradient(11, gradiant_width, gradiant_width, 0);
            gradientSegment.addColorStop(0, '#8696B0');
            gradientSegment.addColorStop(1, '#002F6C');
            window.grafica = new Chart(anatomy_chart_level2, {
                type: 'doughnut',
                data: {
                    labels: ['', '', '', ''],
                    datasets: [{
                        data: [anatomy_porc_level2, anatomy_porc_rest_level2],
                        backgroundColor: [gradientSegment, '#FFECE5'],
                        cutout: radius_grafic
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'none',
                        },
                        title: {
                            display: false,
                            text: ''
                        },
                    }
                },
                plugins: [centerText_chart]
            });

            centerText_chart = {
                id: 'centerText_chart',
                afterDatasetsDraw(chart, args, pluginOptions) {
                    const {
                        ctx,
                        data
                    } = chart;

                    //const text = data.datasets[data.labels[0]];
                    const text = anatomy_porc_level3 + "%";

                    ctx.save();
                    const x = chart.getDatasetMeta(0).data[0].x;
                    const y = chart.getDatasetMeta(0).data[0].y;
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle'
                    ctx.font = font_grafic;
                    ctx.fillStyle = '#002F6C';

                    ctx.fillText(text, x, y);
                }
            }
            var anatomy_chart_level3 = document.getElementById("anatomy_chart_level3").getContext("2d");
            gradientSegment = anatomy_chart_level3.createConicGradient(11, gradiant_width, gradiant_width, 0);
            gradientSegment.addColorStop(0, '#8696B0');
            gradientSegment.addColorStop(1, '#002F6C');
            window.grafica = new Chart(anatomy_chart_level3, {
                type: 'doughnut',
                data: {
                    labels: ['', '', '', ''],
                    datasets: [{
                        data: [anatomy_porc_level3, anatomy_porc_rest_level3],
                        backgroundColor: [gradientSegment, '#FFECE5'],
                        cutout: radius_grafic
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'none',
                        },
                        title: {
                            display: false,
                            text: ''
                        },
                    }
                },
                plugins: [centerText_chart]
            });
        }
    }
});

//Injection charts data
$.ajax({
    type: "POST",
    url: "apis/content.php",
    data: {
        method: "get_chart",
        user_id: getCookie("user_id"),
        category: "injection_techniques"
    },
    dataType: "html",
    beforeSend: function () {},
    error: function () {
        alert("Error de conexión.");
    },
    success: function (data) {
        //console.log(data);
        if (data == "Token ERROR") {
            // alert("Session expired. Please log in again.");
            // document.location = "index.html";
        } else {
            user_contents_data = JSON.parse(data);
            //console.log(user_contents_data);

            var injection_porc_level1 = user_contents_data.injection_perc_1;
            var injection_porc_rest_level1 = 100 - injection_porc_level1;
            var injection_porc_level2 = user_contents_data.injection_perc_2;
            var injection_porc_rest_level2 = 100 - injection_porc_level2;
            var injection_porc_level3 = user_contents_data.injection_perc_3;
            var injection_porc_rest_level3 = 100 - injection_porc_level3;

            // if(injection_porcentage <= 100){
            //     var injection_porc_level1 = injection_porcentage;
            //     var injection_porc_rest_level1 = 100 - injection_porc_level1;

            //     var injection_porc_level2 = 0;
            //     var injection_porc_rest_level2 = 100 - injection_porc_level2;
            //     var injection_porc_level3 = 0;
            //     var injection_porc_rest_level3 = 100 - injection_porc_level3;
            // }else if(injection_porcentage > 100 && injection_porcentage <= 200){
            //     injection_porc_level2 = injection_porcentage - 100; 
            //     injection_porc_rest_level2 = 100 - injection_porc_level2;

            //     injection_porc_level1 = 100;
            //     injection_porc_rest_level1 = 100 - injection_porc_level2;
            //     injection_porc_level3 = 0;
            //     injection_porc_rest_level3 = 100 - injection_porc_level3;
            // }else if(injection_porcentage > 200 && injection_porcentage <= 300){
            //     injection_porc_level3 = injection_porcentage - 200; 
            //     injection_porc_rest_level3 = 100 - injection_porc_level3;

            //     injection_porc_level1 = 100;
            //     injection_porc_rest_level1 = 100 - injection_porc_level2;
            //     injection_porc_level2 = 100;
            //     injection_porc_rest_level2 = 100 - injection_porc_level3;
            // }else{
            //     injection_porc_level1 = 100;
            //     injection_porc_rest_level1 = 100 - injection_porc_level2;
            //     injection_porc_level2 = 100;
            //     injection_porc_rest_level2 = 100 - injection_porc_level3;
            //     injection_porc_level3 = 100; 
            //     injection_porc_rest_level3 = 100 - injection_porc_level3;
            // }

            var centerText_chart = {
                id: 'centerText_chart',
                afterDatasetsDraw(chart, args, pluginOptions) {
                    const {
                        ctx,
                        data
                    } = chart;

                    //const text = data.datasets[data.labels[0]];
                    const text = injection_porc_level1 + "%";

                    ctx.save();
                    const x = chart.getDatasetMeta(0).data[0].x;
                    const y = chart.getDatasetMeta(0).data[0].y;
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle'
                    ctx.font = font_grafic;
                    ctx.fillStyle = '#002F6C';

                    ctx.fillText(text, x, y);
                }
            }
            var injection_chart_level1 = document.getElementById("injection_chart_level1").getContext("2d");
            gradientSegment = injection_chart_level1.createConicGradient(11, gradiant_width, gradiant_width, 0);
            gradientSegment.addColorStop(0, '#8696B0');
            gradientSegment.addColorStop(1, '#002F6C');
            window.grafica = new Chart(injection_chart_level1, {
                type: 'doughnut',
                data: {
                    labels: ['', '', '', ''],
                    datasets: [{
                        data: [injection_porc_level1, injection_porc_rest_level1],
                        backgroundColor: [gradientSegment, '#FFECE5'],
                        cutout: radius_grafic
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'none',
                        },
                        title: {
                            display: false,
                            text: ''
                        },
                    }
                },
                plugins: [centerText_chart]
            });

            centerText_chart = {
                id: 'centerText_chart',
                afterDatasetsDraw(chart, args, pluginOptions) {
                    const {
                        ctx,
                        data
                    } = chart;

                    //const text = data.datasets[data.labels[0]];
                    const text = injection_porc_level2 + "%";

                    ctx.save();
                    const x = chart.getDatasetMeta(0).data[0].x;
                    const y = chart.getDatasetMeta(0).data[0].y;
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle'
                    ctx.font = font_grafic;
                    ctx.fillStyle = '#002F6C';

                    ctx.fillText(text, x, y);
                }
            }
            var injection_chart_level2 = document.getElementById("injection_chart_level2").getContext("2d");
            gradientSegment = injection_chart_level2.createConicGradient(11, gradiant_width, gradiant_width, 0);
            gradientSegment.addColorStop(0, '#8696B0');
            gradientSegment.addColorStop(1, '#002F6C');
            window.grafica = new Chart(injection_chart_level2, {
                type: 'doughnut',
                data: {
                    labels: ['', '', '', ''],
                    datasets: [{
                        data: [injection_porc_level2, injection_porc_rest_level2],
                        backgroundColor: [gradientSegment, '#FFECE5'],
                        cutout: radius_grafic
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'none',
                        },
                        title: {
                            display: false,
                            text: ''
                        },
                    }
                },
                plugins: [centerText_chart]
            });

            centerText_chart = {
                id: 'centerText_chart',
                afterDatasetsDraw(chart, args, pluginOptions) {
                    const {
                        ctx,
                        data
                    } = chart;

                    //const text = data.datasets[data.labels[0]];
                    const text = injection_porc_level3 + "%";

                    ctx.save();
                    const x = chart.getDatasetMeta(0).data[0].x;
                    const y = chart.getDatasetMeta(0).data[0].y;
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle'
                    ctx.font = font_grafic;
                    ctx.fillStyle = '#002F6C';

                    ctx.fillText(text, x, y);
                }
            }
            var injection_chart_level3 = document.getElementById("injection_chart_level3").getContext("2d");
            gradientSegment = injection_chart_level3.createConicGradient(11, gradiant_width, gradiant_width, 0);
            gradientSegment.addColorStop(0, '#8696B0');
            gradientSegment.addColorStop(1, '#002F6C');
            window.grafica = new Chart(injection_chart_level3, {
                type: 'doughnut',
                data: {
                    labels: ['', '', '', ''],
                    datasets: [{
                        data: [injection_porc_level3, injection_porc_rest_level3],
                        backgroundColor: [gradientSegment, '#FFECE5'],
                        cutout: radius_grafic
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'none',
                        },
                        title: {
                            display: false,
                            text: ''
                        },
                    }
                },
                plugins: [centerText_chart]
            });
        }
    }
});

//Webinars charts data
$.ajax({
    type: "POST",
    url: "apis/content.php",
    data: {
        method: "get_chart",
        user_id: getCookie("user_id"),
        category: "webinars"
    },
    dataType: "html",
    beforeSend: function () {},
    error: function () {
        alert("Error de conexión.");
    },
    success: function (data) {
        //console.log(data);
        if (data == "Token ERROR") {
            // alert("Session expired. Please log in again.");
            // document.location = "index.html";
        } else {
            user_contents_data = JSON.parse(data);
            //console.log(user_contents_data);

            var webinars_porc_level1 = user_contents_data.webinars_perc_1;
            var webinars_porc_rest_level1 = 100 - webinars_porc_level1;
            var webinars_porc_level2 = user_contents_data.webinars_perc_2;
            var webinars_porc_rest_level2 = 100 - webinars_porc_level2;
            var webinars_porc_level3 = user_contents_data.webinars_perc_3;
            var webinars_porc_rest_level3 = 100 - webinars_porc_level3;

            // if(webinars_porcentage <= 100){
            //     var webinars_porc_level1 = webinars_porcentage;
            //     var webinars_porc_rest_level1 = 100 - webinars_porc_level1;

            //     var webinars_porc_level2 = 0;
            //     var webinars_porc_rest_level2 = 100 - webinars_porc_level2;
            //     var webinars_porc_level3 = 0;
            //     var webinars_porc_rest_level3 = 100 - webinars_porc_level3;
            // }else if(webinars_porcentage > 100 && webinars_porcentage <= 200){
            //     webinars_porc_level2 = webinars_porcentage - 100; 
            //     webinars_porc_rest_level2 = 100 - webinars_porc_level2;

            //     webinars_porc_level1 = 100;
            //     webinars_porc_rest_level1 = 100 - webinars_porc_level2;
            //     webinars_porc_level3 = 0;
            //     webinars_porc_rest_level3 = 100 - webinars_porc_level3;
            // }else if(webinars_porcentage > 200 && webinars_porcentage <= 300){
            //     webinars_porc_level3 = webinars_porcentage - 200; 
            //     webinars_porc_rest_level3 = 100 - webinars_porc_level3;

            //     webinars_porc_level1 = 100;
            //     webinars_porc_rest_level1 = 100 - webinars_porc_level2;
            //     webinars_porc_level2 = 100;
            //     webinars_porc_rest_level2 = 100 - webinars_porc_level3;
            // }else{
            //     webinars_porc_level1 = 100;
            //     webinars_porc_rest_level1 = 100 - webinars_porc_level2;
            //     webinars_porc_level2 = 100;
            //     webinars_porc_rest_level2 = 100 - webinars_porc_level3;
            //     webinars_porc_level3 = 100; 
            //     webinars_porc_rest_level3 = 100 - webinars_porc_level3;
            // }

            var centerText_chart = {
                id: 'centerText_chart',
                afterDatasetsDraw(chart, args, pluginOptions) {
                    const {
                        ctx,
                        data
                    } = chart;

                    //const text = data.datasets[data.labels[0]];
                    const text = webinars_porc_level1 + "%";

                    ctx.save();
                    const x = chart.getDatasetMeta(0).data[0].x;
                    const y = chart.getDatasetMeta(0).data[0].y;
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle'
                    ctx.font = font_grafic;
                    ctx.fillStyle = '#002F6C';

                    ctx.fillText(text, x, y);
                }
            }
            var webinars_chart_level1 = document.getElementById("webinars_chart_level1").getContext("2d");
            gradientSegment = webinars_chart_level1.createConicGradient(11, gradiant_width, gradiant_width, 0);
            gradientSegment.addColorStop(0, '#8696B0');
            gradientSegment.addColorStop(1, '#002F6C');
            window.grafica = new Chart(webinars_chart_level1, {
                type: 'doughnut',
                data: {
                    labels: ['', '', '', ''],
                    datasets: [{
                        data: [webinars_porc_level1, webinars_porc_rest_level1],
                        backgroundColor: [gradientSegment, '#FFECE5'],
                        cutout: radius_grafic
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'none',
                        },
                        title: {
                            display: false,
                            text: ''
                        },
                    }
                },
                plugins: [centerText_chart]
            });

            centerText_chart = {
                id: 'centerText_chart',
                afterDatasetsDraw(chart, args, pluginOptions) {
                    const {
                        ctx,
                        data
                    } = chart;

                    //const text = data.datasets[data.labels[0]];
                    const text = webinars_porc_level2 + "%";

                    ctx.save();
                    const x = chart.getDatasetMeta(0).data[0].x;
                    const y = chart.getDatasetMeta(0).data[0].y;
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle'
                    ctx.font = font_grafic;
                    ctx.fillStyle = '#002F6C';

                    ctx.fillText(text, x, y);
                }
            }
            var webinars_chart_level2 = document.getElementById("webinars_chart_level2").getContext("2d");
            gradientSegment = webinars_chart_level2.createConicGradient(11, gradiant_width, gradiant_width, 0);
            gradientSegment.addColorStop(0, '#8696B0');
            gradientSegment.addColorStop(1, '#002F6C');
            window.grafica = new Chart(webinars_chart_level2, {
                type: 'doughnut',
                data: {
                    labels: ['', '', '', ''],
                    datasets: [{
                        data: [webinars_porc_level2, webinars_porc_rest_level2],
                        backgroundColor: [gradientSegment, '#FFECE5'],
                        cutout: radius_grafic
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'none',
                        },
                        title: {
                            display: false,
                            text: ''
                        },
                    }
                },
                plugins: [centerText_chart]
            });

            centerText_chart = {
                id: 'centerText_chart',
                afterDatasetsDraw(chart, args, pluginOptions) {
                    const {
                        ctx,
                        data
                    } = chart;

                    //const text = data.datasets[data.labels[0]];
                    const text = webinars_porc_level3 + "%";

                    ctx.save();
                    const x = chart.getDatasetMeta(0).data[0].x;
                    const y = chart.getDatasetMeta(0).data[0].y;
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle'
                    ctx.font = font_grafic;
                    ctx.fillStyle = '#002F6C';

                    ctx.fillText(text, x, y);
                }
            }
            var webinars_chart_level3 = document.getElementById("webinars_chart_level3").getContext("2d");

            gradientSegment = webinars_chart_level3.createConicGradient(11, gradiant_width, gradiant_width, 0);
            gradientSegment.addColorStop(0, '#8696B0');
            gradientSegment.addColorStop(1, '#002F6C');

            window.grafica = new Chart(webinars_chart_level3, {
                type: 'doughnut',
                data: {
                    labels: ['', '', '', ''],
                    datasets: [{
                        data: [webinars_porc_level3, webinars_porc_rest_level3],
                        backgroundColor: [gradientSegment, '#FFECE5'],
                        cutout: radius_grafic
                    }]

                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'none',
                        },
                        title: {
                            display: false,
                            text: ''
                        },
                    }
                },
                plugins: [centerText_chart]
            });
        }
    }
});

var first_name_old = "";
var last_name_old = "";
var clinic_name_old = "";

function edit_save_personal_details() {
    if ($("#edit_personal").css("display") == "block") {
        first_name_old = $("#first_name").val();
        last_name_old = $("#last_name").val();
        clinic_name_old = $("#clinic_name").val();

        $("#edit_personal").css("display", "none");
        $("#save_personal").css("display", "block");

        $(".edit #edit_text_personal").empty();
        $(".edit #edit_text_personal").append("Save");



        $("#first_name").prop("readonly", false);
        $("#last_name").prop("readonly", false);
        $("#clinic_name").prop("readonly", false);
    } else {
        $("#edit_personal").css("display", "block");
        $("#save_personal").css("display", "none");

        $(".edit #edit_text_personal").empty();
        $(".edit #edit_text_personal").append("Edit");

        $("#first_name").prop("readonly", true);
        $("#last_name").prop("readonly", true);
        $("#clinic_name").prop("readonly", true);

        Swal.fire({
            icon: "",
            title: "Update personal data<br>Are you sure?",
            showCancelButton: true,
            confirmButtonText: 'Accept',
            cancelButtonText: `Cancel`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "apis/user.php",
                    data: {
                        method: "update_personal_details",
                        first_name: $("#first_name").val(),
                        last_name: $("#last_name").val(),
                        clinic_name: $("#clinic_name").val()
                    },
                    dataType: "html",
                    beforeSend: function () {},
                    error: function () {
                        alert("Error de conexión.");
                    },
                    success: function (data) {
                        //console.log(data)            
                        if (data == "ok") {
                            Swal.fire({
                                icon: "success",
                                title: 'You have successfully<br>modified your profile',
                                showCancelButton: false,
                                confirmButtonText: 'Accept',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            })
                        } else {
                            Swal.fire({
                                icon: "warning",
                                title: "There's been a problem.",
                                showCancelButton: false,
                                confirmButtonText: 'Accept',
                            }).then((result) => {
                                if (result.isConfirmed) {}
                            })
                        }

                    }
                })
            } else {
                //console.log(first_name_old)
                $("#first_name").val(first_name_old);
                $("#last_name").val(last_name_old);
                $("#clinic_name").val(clinic_name_old);
            }
        })
    }
}

function edit_save_password() {
    if ($("#edit_password").css("display") == "block") {
        $("#edit_password").css("display", "none");
        $("#save_password").css("display", "block");

        $(".edit #edit_text_password").empty();
        $(".edit #edit_text_password").append("Save");

        $("#password_rules").fadeIn();

        $("#password").prop("readonly", false);
        $("#password").val("");

        $("#new_password_container").css("visibility", "visible");
        $("#new_password_container").css("height", "103px");

        $("#repeat_new_password_container").css("visibility", "visible");
        $("#repeat_new_password_container").css("height", "103px");
    } else {
        $("#edit_password").css("display", "block");
        $("#save_password").css("display", "none");

        $(".edit #edit_text_password").empty();
        $(".edit #edit_text_password").append("Edit");

        $("#password_rules").fadeOut();
        $("#password").prop("readonly", true);
        $("#new_password_container").css("visibility", "hidden");
        $("#new_password_container").css("height", "0");

        $("#repeat_new_password_container").css("visibility", "hidden");
        $("#repeat_new_password_container").css("height", "0");


        Swal.fire({
            icon: "",
            title: "Password update<br>Are you sure?",
            showCancelButton: true,
            confirmButtonText: 'Accept',
            cancelButtonText: `Cancel`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "apis/user.php",
                    data: {
                        method: "update_password_profile",
                        password: $("#password").val(),
                        new_password: $("#new_password").val(),
                        repeat_new_password: $("#repeat_new_password").val()
                    },
                    dataType: "html",
                    beforeSend: function () {},
                    error: function () {
                        alert("Error de conexión.");
                    },
                    success: function (data) {
                        //console.log(data)            
                        if (data == "ok") {
                            Swal.fire({
                                icon: "success",
                                title: 'You have successfully<br>modified your profile',
                                showCancelButton: false,
                                confirmButtonText: 'Accept',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            })
                            $("#password").val("");
                            $("#new_password").val("");
                            $("#repeat_new_password").val("");
                        } else {
                            $("#password").val("");
                            $("#new_password").val("");
                            $("#repeat_new_password").val("");
                            if (data == "error_pass") {
                                Swal.fire({
                                    icon: "warning",
                                    title: "Password was not updated<br>Your password is incorrect",
                                    showCancelButton: false,
                                    confirmButtonText: 'Accept',
                                }).then((result) => {
                                    if (result.isConfirmed) {}
                                })
                            } else {
                                Swal.fire({
                                    icon: "warning",
                                    title: "There's been a problem.<br>Password was not updated",
                                    showCancelButton: false,
                                    confirmButtonText: 'Accept',
                                }).then((result) => {
                                    if (result.isConfirmed) {}
                                })
                            }
                        }
                    }
                })
            } else {
                $("#password").val("");
                $("#new_password").val("");
                $("#repeat_new_password").val("");
            }
        })
    }
}


//Comprobar que pasword cumpla condiciones
function checkPasswordStrength(password_input) {
    password = password_input.value;

    // Initialize variables
    var strength = 0;
    var tips = "";
    //console.log(strength);

    if (strength == 0) {
        $(".minimo_caracteres").removeClass('completado');
        $(".numeros").removeClass('incompleto');
        $(".minusculas").removeClass('incompleto');
        $(".mayusculas").removeClass('incompleto');
        $(".especial").removeClass('incompleto');
    }

    // Check password length
    if (password.length < 8) {
        $(".minimo_caracteres").removeClass('completado');
        $(".minimo_caracteres").addClass('incompleto');
    } else {
        $(".minimo_caracteres").addClass('completado');
        $(".minimo_caracteres").removeClass('incompleto');
        strength += 1;
    }

    var tiene_num = tiene_numeros(password);
    if (tiene_num == 1) {
        $(".numeros").addClass('completado');
        $(".numeros").removeClass('incompleto');
        strength += 1;
    } else {
        $(".numeros").removeClass('completado');
        $(".numeros").addClass('incompleto');

    }

    var tiene_letra = tiene_minusculas(password);
    if (tiene_letra == 1) {
        $(".minusculas").addClass('completado');
        $(".minusculas").removeClass('incompleto');
        strength += 1;
    } else {
        $(".minusculas").removeClass('completado');
        $(".minusculas").addClass('incompleto');

    }

    var tiene_letra_may = tiene_mayusculas(password);
    if (tiene_letra_may == 1) {
        $(".mayusculas").addClass('completado');
        $(".mayusculas").removeClass('incompleto');
        strength += 1;
    } else {
        $(".mayusculas").removeClass('completado');
        $(".mayusculas").addClass('incompleto');

    }

    var tiene_especial = checkPassword(password);
    if (tiene_especial == 1) {
        $(".especial").addClass('completado');
        $(".especial").removeClass('incompleto');
        strength += 1;
    } else {
        $(".especial").removeClass('completado');
        $(".especial").addClass('incompleto');

    }

    if (password_input.id == "new_password") {
        passw2 = "repeat_new_password";
    }

    if (strength >= 5) {
        $("#" + passw2).val('');
        $("#" + passw2).css('opacity', '1');
        $("#" + passw2).attr('readonly', false);
        $("#" + passw2).removeClass('input_incorrect');

        $("#btn_" + passw2).removeClass("btn_des");
    } else {
        $("#" + passw2).val('');
        $("#" + passw2).css('opacity', '0.5');
        $("#" + passw2).attr('readonly', true);
        $("#" + passw2).removeClass('input_incorrect');

        $("#btn_" + passw2).addClass("btn_des");
    }
}

//Funciones para comprobar que pasword cumpla condiciones
function tiene_numeros(texto) {
    var numeros = "0123456789";
    for (i = 0; i < texto.length; i++) {
        if (numeros.indexOf(texto.charAt(i), 0) != -1) {
            return 1;
        }
    }
    return 0;
}

function tiene_minusculas(texto) {
    var letras = "abcdefghyjklmnñopqrstuvwxyz";
    for (i = 0; i < texto.length; i++) {
        if (letras.indexOf(texto.charAt(i), 0) != -1) {
            return 1;
        }
    }
    return 0;
}

function tiene_mayusculas(texto) {
    var letras_mayusculas = "ABCDEFGHYJKLMNÑOPQRSTUVWXYZ";
    for (i = 0; i < texto.length; i++) {
        if (letras_mayusculas.indexOf(texto.charAt(i), 0) != -1) {
            return 1;
        }
    }
    return 0;
}

function checkPassword(texto) {
    var re = "[!@#\$%\^&\*_]";
    //return re.test(str);

    for (i = 0; i < texto.length; i++) {
        if (re.indexOf(texto.charAt(i), 0) != -1) {
            return 1;
        }
    }
    return 0;
}

//Verificar password y confirmación
function comprueba_contrasena(e1, e2) {
    if (e1.value != "" && e2.value != "") {

        if (e1.value != e2.value) {
            $("#incorrect_" + e2.id).css('visibility', 'visible');
            $("#" + e2.id).addClass('input_incorrect');
            $("#" + e2.id).val("");
        } else {
            if (e1.id == "pass1") {
                $("#button_save_pass").attr('onclick', "updatePass()");
            }
            if (e1.id == "pass1_first") {
                $("#button_save_pass_first").attr('onclick', "new_password_first()");
            }
        }
    }
}

//Resetear inputs olvidados
function quitarError(objet) {
    $("#" + objet.id).removeClass('input_incorrect');
    $("#incorrect_" + objet.id).css('visibility', 'hidden');
    $("#incorrect_format_" + objet.id).css('visibility', 'hidden');
    $("#exists_" + objet.id).css("visibility", "hidden");
}

//Select language
function select_language() {
    language = $("#select_language").val();
    changeLenguage(language);

    document.cookie = "language=" + language;
}

function select_language_mobile() {
    language = $("#select_language_mobile").val();
    changeLenguage(language);

    document.cookie = "language=" + language;
}

//Scroll touch functions 'Marketing materials' carousel
$('#container_carousel_materials').swipe({
    swipe: function (event, direction, distance, duration, fingerCount) {
        object_scroll = $('#container_carousel_materials').attr("id").replace("container_carousel_", "");
        switch (direction) {
            case 'left':
                $("#container_carousel_materials").scrollLeft($("#container_carousel_materials").scrollLeft() + 264);
                break;
            case 'right':
                $("#container_carousel_materials").scrollLeft($("#container_carousel_materials").scrollLeft() - 264);
                break;
        }
        setTimeout(() => {
            check_end_scroll(object_scroll);
        }, 700);
    },
    allowPageScroll: "vertical"
});

//Scroll touch functions 'Favourite presentations' carousel
$('#container_carousel_favourite_document').swipe({
    swipe: function (event, direction, distance, duration, fingerCount) {
        object_scroll = $('#container_carousel_favourite_document').attr("id").replace("container_carousel_", "");
        switch (direction) {
            case 'left':
                $("#container_carousel_favourite_document").scrollLeft($("#container_carousel_favourite_document").scrollLeft() + 264);
                break;
            case 'right':
                $("#container_carousel_favourite_document").scrollLeft($("#container_carousel_favourite_document").scrollLeft() - 264);
                break;
        }
        setTimeout(() => {
            check_end_scroll(object_scroll);
        }, 700);
    },
    allowPageScroll: "vertical"
});

//Scroll touch functions 'Favourite videos' carousel
$('#container_carousel_favourite_video').swipe({
    swipe: function (event, direction, distance, duration, fingerCount) {
        object_scroll = $('#container_carousel_favourite_video').attr("id").replace("container_carousel_", "");
        switch (direction) {
            case 'left':
                $("#container_carousel_favourite_video").scrollLeft($("#container_carousel_favourite_video").scrollLeft() + 264);
                break;
            case 'right':
                $("#container_carousel_favourite_video").scrollLeft($("#container_carousel_favourite_video").scrollLeft() - 264);
                break;
        }
        setTimeout(() => {
            check_end_scroll(object_scroll);
        }, 700);
    },
    allowPageScroll: "vertical"
});

//Leer cookies
function getCookie(name) {
    var value = "; " + document.cookie;
    var parts = value.split("; " + name + "=");
    if (parts.length == 2) return parts.pop().split(";").shift();
}

//Limpiamos la descripción de htmls
function limpia_texto(texto) {
    re = /<p>/g;
    texto = texto.replace(re, "");
    re = /<\/p>/g;
    texto = texto.replace(re, "");
    re = /<b>/g;
    texto = texto.replace(re, "");
    re = /<\/b>/g;
    texto = texto.replace(re, "");
    re = /<strong>/g;
    texto = texto.replace(re, "");
    re = /<\/strong>/g;
    texto = texto.replace(re, "");
    re = /<sub>/g;
    texto = texto.replace(re, "");
    re = /<\/sub>/g;
    texto = texto.replace(re, "");
    re = /<sup>/g;
    texto = texto.replace(re, "");
    re = /<\/sup>/g;
    texto = texto.replace(re, "");
    re = /<ol>/g;
    texto = texto.replace(re, "");
    re = /<\/ol>/g;
    texto = texto.replace(re, "");
    re = /<ul>/g;
    texto = texto.replace(re, "");
    re = /<\/ul>/g;
    texto = texto.replace(re, "");
    re = /<li>/g;
    texto = texto.replace(re, "");
    re = /<\/li>/g;
    texto = texto.replace(re, "");
    re = /<em>/g;
    texto = texto.replace(re, "");
    re = /<\/em>/g;
    texto = texto.replace(re, "");

    return texto;
}
