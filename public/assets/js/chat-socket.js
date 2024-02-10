let chat_user;
let chat_group;
var page = 1;
var processing = true;
var on_top = false;

//let socket = io(socket_host);
//socket.on('connection');
let socket = io('http://localhost:8000/'); 
// let socket = io('http://45.90.223.64:3000/');

//const socket = io('https://peeq.com.au/staging:3000', {
 // path: '/socket.io',
 // transports: ['websocket'],
//});

// socket.on('connection', (socket)=>{
//     console.log('connection========', socket);
// }); // Arvind commented on 12-01-2024
//const socket = io('https://peeq.com.au/staging/:3000', {
 // path: 'https://peeq.com.au/staging/:3000',
//});
socket.on('connection');

socket.on('connect_failed', function(status) {
    connectionLost();
});

socket.on( 'disconnect', function() {
    connectionLost();
});

socket.on('error', function(status) {
    connectionLost();
});

socket.on('connect', function(status) {
    connectionBack();
});

function connectionLost() {
    console.log("Connection Lost!");
    $('.msg_head').addClass('bg-danger');
}

function connectionBack() {
console.log('Connection back');
    socket.emit('vendorCreate', { user: from_user });
    $('.msg_head').removeClass('bg-danger');
}


socket.on('networkStatus', function(response) {
    try {
        if (response.status == 1) {
            
            // $('#chat-user-' + response.user_id).find('.status-circle').removeClass('di__user_status');
            $('#chat-user-' + response.user_id).find('.status-circle').addClass('di__user_status--live');
        } else {
            $('#chat-user-' + response.user_id).find('.status-circle').removeClass('di__user_status--live');
            // $('#chat-user-' + response.user_id).find('.status-circle').addClass('di__user_status');
        }
    } catch (error) {
        console.error(error);
    }
});

// online offline user status
// socket.on('networkStatus', function(response) {
//     try {
//         if (response.status == 1) {
//             $('#chat-user-' + response.user_id).find('.point_round').css('background', 'green');
//         } else {
//             $('#chat-user-' + response.user_id).find('.point_round').css('background', 'red');
//         }
//     } catch (error) {
//         console.error(error);
//     }
// });

$(document).ready(function () {
    // $('.leave-group-btn').remove();
    // $('.delete-group-btn').remove();
    chat_user = getUserById($('#contact-list').find('.active').data('user'));
    $('#chat_user_name').html('');
        if (chat_user) {
            $('#chat_user_name').html(chat_user.name);
            // $('#user_type').html(chat_user.user_type);
            $('#chat_user_profile').attr('src', chat_user.profile_image);
            $('.message_count').html(chat_user.message_count);                        
            page = 1;
            on_top = false;
            getUserChat(chat_user.id, 1, false, true);
        }
        else {
            $('ui#contact-list li:first-child').click();
        }
});


$(document).on('keyup', '#message', function (e) {
    e.preventDefault();
    if (e.keyCode == 13 && !e.shiftKey) {
        if (!$(this).val().includes('@')) {
            $('.send_btn').trigger('click');
        }
    }
});

$(document).on('click', '.chat-user', function (e) {
    e.preventDefault();
    chat_group = '';
    
    // alert('hjudshjhj');
    // $('.add_member').remove();
    // $('.leave-group-btn').remove();
    // $('.delete-group-btn').remove();
    chat_user = getUserById($(this).attr('data-user'));
    $(this).closest('li').addClass('active');
    $('.chat-user').removeClass('active');
    $(this).addClass('active');
    // $('.chat-group').removeClass('active');
    $('#chat_user_name').html('');
    // $("#user_msg_"+chat_user.id).text('');
    // $("#user_msg_"+chat_user.id).removeClass('badge rounded-circle');    
    if (chat_user) {
        // console.log('chat_user name called i am in chat_user',chat_user);
        $('#chat_user_name').html(chat_user.name);
        // $('#user_type').html(chat_user.user_type);   
        $('.message_count').html(chat_user.allMessageCount+ ' Messages');   
             
        $('#chat_user_profile').attr('src', chat_user.profile_image);
        page = 1;
        on_top = false;
        getUserChat(chat_user.id, 1, false, true);
    }
});

// socket.on('message', function(msg) {
//     console.log(msg.message);
//     if (msg.message != '') {
//         decodeString(msg.message, function(decode_message) {
//         if (msg.from == from_user.id) {
//             let rowRes = [];
//             var lstRows = new Array();
//             rowRes.message = decode_message;
//             rowRes.profile_photo_path = msg.from_user_profile_url;
//             rowRes.time = moment().format('HH:mm');
//             lstRows.push(rowRes);
            
            
//             if (msg.from == chat_user.id) {
                
//                 $('#chat-user-'+chat_user.id+'').find('p.user_last_msg').text(decode_message);
//                 if (chat_user.last_message == '' || chat_user.last_message == null) {
//                     var now_date_ur = moment().format('DD-MMM-YYYY');
//                     var pre_dt_ur = $(".lst_ur_msg_dt").text();
                    
//                     if (pre_dt_ur != now_date_ur) {
//                         $(".msg_card_body").append('<div class="d-flex justify-content-center"><p class="mb-2 lst_ur_msg_dt">'+now_date_ur+' </p></div>');
//                     }
//                 } else {
//                     var lastMsgDt = moment.utc(chat_user.last_message.display_date, "YYYY-MM-DD'T'HH:mm:ss.SSSSSS'Z'").toDate();
//                     var lastMsg_date = moment(lastMsgDt).format('DD-MMM-YYYY');
//                     var now_date_ur = moment().format('DD-MMM-YYYY');
//                     if (lastMsg_date != now_date_ur) {
//                         var pre_dt_ur = $(".lst_ur_msg_dt").text();
//                         if (pre_dt_ur != now_date_ur) {
//                             $(".msg_card_body").append('<div class="d-flex justify-content-center"><p class="mb-2 lst_ur_msg_dt">'+now_date_ur+' </p></div>');
//                         }
//                     }
//                 }
//                 // $('#chat_user_messages_count').text(Number($('#chat_user_messages_count').text()) + 1);
                
//                 // var jsSelfTemplate = '<li class="clearfix"><div class="message my-message">   <div class="d-flex justify-content-end mb-2 chat_box">                        <div class="msg_container">  <div class="d-flex align-items-end gap-2"> <p class="mb-0">'+ lstRows +'</p></div></div></div></div></li>';
//                 console.log("appended message rows1: ",lstRows);
//                 $(".msg_card_body").prepend(lstRows);
//             } else {
//                 $('#chat-user-'+msg.from+'').find('p.user_last_msg').text(decode_message);
//                 let cont = $('#user_msg_' + msg.from).html();
//                 if (cont == '' || cont == null || cont == 'undefined' || isNaN(cont)) {
//                     cont = 0;
//                 }
//                 cont = parseInt(cont) + 1;
//                 // console.log(cont);
//                 $('#user_msg_' + msg.from).html(cont);
//             }
//         } else if (msg.from == chat_user.id) {
//             let rowRes = [];
//             var lstRows = new Array();
//             rowRes.message = decode_message;
//             if (from_user.id == msg.from) {
//                 rowRes.profile_photo_path = msg.from_user_profile_url;
//             } else {
//                 rowRes.profile_photo_path = msg.to_user_profile_url;
//             }
//             rowRes.time = moment().format('HH:mm');
//             lstRows.push(rowRes);
//             if (chat_user.last_message == '' || chat_user.last_message == null) {
//                 var now_date_ur = moment().format('DD-MMM-YYYY');
//                 var pre_dt_ur = $(".lst_ur_msg_dt").text();
//                 if (pre_dt_ur != now_date_ur) {
//                     $(".msg_card_body").prepend('<div class="d-flex justify-content-center"><p class="mb-2 lst_ur_msg_dt"> '+now_date_ur+' </p></div>');
//                 }
//             } else {
//                 var lastMsgDt = moment.utc(chat_user.last_message.display_date, "YYYY-MM-DD'T'HH:mm:ss.SSSSSS'Z'").toDate();
//                 var lastMsg_date = moment(lastMsgDt).format('DD-MMM-YYYY');
//                 var now_date_ur = moment().format('DD-MMM-YYYY');
//                 if (lastMsg_date != now_date_ur) {
//                     var pre_dt_ur = $(".lst_ur_msg_dt").text();
//                     if (pre_dt_ur != now_date_ur) {
//                         $(".msg_card_body").prepend('<div class="d-flex justify-content-center"><p class="mb-2 lst_ur_msg_dt"> '+now_date_ur+' </p></div>');
//                     }
//                 }
//             }
            
//             var OtherMessage = '<li class="clearfix"><div class="message other-message"><div class="d-flex justify-content-start mb-2 chat_box gap-2"><div class="msg_container"><div class="d-flex align-items-end gap-2"><p class="mb-0">'+msg.message+'</p><span class="text-sm-10 mb-0 lst_ur_msg_dt">'+now_date_ur+'</span></div></div></div></div></li>';
//             $(".msg_card_body").prepend(OtherMessage);
//         } else {
//             let cont = $('#user_msg_' + msg.from).html();
//             if (cont == '' || cont == null || cont == 'undefined' || isNaN(cont)) {
//                 cont = 0;
//             }
//             cont = parseInt(cont) + 1;
            
//             $('#user_msg_' + msg.from).html(cont);
//         }
        
//         $('#chat-user-'+msg.from+'').find('p.user_last_msg').text(decode_message);
//         var first_user = $('#contact-list').find('#chat-user-'+msg.from+'');
//         first_user.remove();
//         $('#contact-list').prepend(first_user);
//         });
        
//         $('.chat-history-main').stop().animate({
//             scrollTop: $('.chat-history-main')[0].scrollHeight
//         }, 1500);
        
//         // $('#chat_msg').stop().animate({
//         //     scrollTop: $('#chat_msg')[0].scrollHeight
//         // }, 1500);
//     }
// });


socket.on('message', function(msg) {
    // decodeString(msg.message, function(decode_message) {
    console.log('message called foe other user = ',msg);
    if (msg.group_id == undefined || msg.group_id == '' || msg.group_id == null) {
        if (msg.documents != 'undefined' || msg.documents.length > 0) {
            $.each(msg.documents, function (index, doc) {
                let rowDocRes = [];
                var lstDocRows = new Array();
                rowDocRes.message = doc.document_url;
                rowDocRes.document_name = doc.document;
                rowDocRes.time = moment().format('HH:mm');
                rowDocRes.profile_photo_path = msg.from_user_profile_url;
                lstDocRows.push(rowDocRes);
                if (msg.from == from_user.id) {
                    if (msg.from == chat_user.id) {
                        if (chat_user.last_message == '' || chat_user.last_message == null) {
                            var now_date_ur = moment().format('DD-MMM-YYYY');
                            var pre_dt_ur = $(".lst_ur_msg_dt").text();
                            if (pre_dt_ur != now_date_ur) {
                                $(".msg_card_body").append('<div class="d-flex justify-content-center"><p class="lst_ur_msg_dt">'+now_date_ur+'</p></div>');
                            }
                        } else {
                            var lastMsgDt = moment.utc(chat_user.last_message.display_date, "YYYY-MM-DD'T'HH:mm:ss.SSSSSS'Z'").toDate();
                            var lastMsg_date = moment(lastMsgDt).format('DD-MMM-YYYY');
                            var now_date_ur = moment().format('DD-MMM-YYYY');
                            if (lastMsg_date != now_date_ur) {
                                var pre_dt_ur = $(".lst_ur_msg_dt").text();
                                if (pre_dt_ur != now_date_ur) {
                                    $(".msg_card_body").append('<div class="d-flex justify-content-center"><p class="lst_ur_msg_dt">'+now_date_ur+'</p></div>');
                                }
                            }
                        }
                        $('#chat_user_messages_count').text(Number($('#chat_user_messages_count').text()) + 1);
                        if (checkImage(rowDocRes.message)) {
                            appendUserchat(lstRows,'self','img','append');
                        } else if (checkVideo(rowDocRes.message)) {
                            appendUserchat(lstRows,'self','video','append');
                        } else if (checkAudio(rowDocRes.message)) {
                            appendUserchat(lstRows,'self','audio','append');
                        } else {
                            appendUserchat(lstRows,'self','doc','append');
                        }
                    } else {
                        var cont = $('#user_msg_' + msg.from).html();
                        if (cont == '' || cont == null || cont == 'undefined' || isNaN(cont)) {
                            cont = 0;
                        }
                        cont = parseInt(cont) + 1;
                        $('#user_msg_' + msg.from).html(cont);
                    }
                } else if (msg.from == chat_user.id) {
                    $('#chat_user_messages_count').text(Number($('#chat_user_messages_count').text()) + 1);
                    if (chat_user.last_message == '' || chat_user.last_message == null) {
                        var now_date_ur = moment().format('DD-MMM-YYYY');
                        var pre_dt_ur = $(".lst_ur_msg_dt").text();
                        if (pre_dt_ur != now_date_ur) {
                            $(".msg_card_body").append('<div class="d-flex justify-content-center"><p class="lst_ur_msg_dt">'+now_date_ur+'</p></div>');
                        }
                    } else {
                        var lastMsgDt = moment.utc(chat_user.last_message.display_date, "YYYY-MM-DD'T'HH:mm:ss.SSSSSS'Z'").toDate();
                        var lastMsg_date = moment(lastMsgDt).format('DD-MMM-YYYY');
                        var now_date_ur = moment().format('DD-MMM-YYYY');
                        if (lastMsg_date != now_date_ur) {
                            var pre_dt_ur = $(".lst_ur_msg_dt").text();
                            if (pre_dt_ur != now_date_ur) {
                                $(".msg_card_body").append('<div class="d-flex justify-content-center"><p class="lst_ur_msg_dt">'+now_date_ur+'</p></div>');
                            }
                        }
                    }
                                       
                    if (checkImage(rowDocRes.message)) {
                        //appendUserchat(lstDocRows,'user','img','append');
                        console.log('for test =',rowDocRes);
                        console.log('This is calling for img to show on user side real time chat 11');
                        
                        
                        // var Message = '<li class="clearfix"><div class="message user-message my-message"><div class="d-flex justify-content-start mb-2 chat_box position-relative">';
                        // Message +='<div class="d-flex align-items-start gap-3">';
                        // Message +='<div class="contact-avatar"><img src="'+rowDocRes.profile_photo_path+'" alt="avatar" width="45" height="45" class="rounded-circle bg-primary"></div>';
                        // Message += '<div class="msg_container"><a href="'+rowDocRes.message+'" target="_blank"><p class="mb-0"><img class="chat_image" width="200px;" height="200px;" src="'+rowDocRes.message+'"></img></p></a></div>';
                        // Message += '</div>';
                        // Message += '<span class="di__chat_time text-tiny mb-0 lst_ur_msg_dt">'+rowDocRes.time+'</span>';
                        // Message += '</div></div></li>';
                        // $(".msg_card_body").append(Message);
                        
                        appendUserchat(rowDocRes,'user','img','append');
        
                    } else if (checkVideo(rowDocRes.message)) {
                        appendUserchat(lstDocRows,'user','video','append');
                    } else if (checkAudio(rowDocRes.message)) {
                        appendUserchat(lstDocRows,'user','audio','append');
                    } else {
                        //appendUserchat(lstDocRows,'user','doc','append');
                        
                        var Message = '<li class="clearfix"><div class="message user-message my-message"><div class="d-flex justify-content-start mb-2 chat_box position-relative">';
                        Message +='<div class="d-flex align-items-start gap-3">';
                        Message +='<div class="contact-avatar"><img src="'+rowDocRes.profile_photo_path+'" alt="avatar" width="45" height="45" class="rounded-circle bg-primary"></div>';
                        Message += '<div class="msg_container"><a href="'+rowDocRes.message+'" target="_blank"><p class="mb-0">'+rowDocRes.message+'</p></a></div>';
                        Message += '</div>';
                        Message += '<span class="di__chat_time text-tiny mb-0 lst_ur_msg_dt">'+rowDocRes.time+'</span>';
                        Message += '</div></div></li>';
                        $(".msg_card_body").append(Message);
                        
                        console.log('latest message here');
                        
                    }
                    /// Need to update here
                    
                } else {
                    var cont = $('#user_msg_' + msg.from).html();
                    if (cont == '' || cont == null || cont == 'undefined' || isNaN(cont)) {
                        cont = 0;
                    }
                    cont = parseInt(cont) + 1;
                    $('#user_msg_' + msg.from).html(cont);
                }
                $('#chat-user-'+msg.from+'').find('p.user_last_msg').text(doc.document);
            });
            console.log('Error is here',msg.from);
            //var first_user = $('#contact-list').find('#chat-user-'+msg.from+'');
            //first_user.remove();
            
            //$('#contact-list').prepend(first_user);
        }
        if (msg.message != '') {
            console.log("by arvind ",chat_user);
            
            decodeString(msg.message, function(decode_message) {
            if (msg.from == from_user.id) {
                console.log('encoded message', msg.message);
                decode_message = msg.message;
                let rowRes = [];
                var lstRows = new Array();
                rowRes.message = msg.message;
                rowRes.profile_photo_path = msg.from_user_profile_url;
                rowRes.time = moment().format('HH:mm');
                lstRows.push(rowRes);
                if (msg.from == chat_user.id) {
                    $('#chat-user-'+chat_user.id+'').find('p.user_last_msg').text(decode_message);
                    if (chat_user.last_message == '' || chat_user.last_message == null) {
                        var now_date_ur = moment().format('DD-MMM-YYYY');
                        var pre_dt_ur = $(".lst_ur_msg_dt").text();
                        if (pre_dt_ur != now_date_ur) {
                            $(".msg_card_body").append('<div class="d-flex justify-content-center"><p class="lst_ur_msg_dt">'+now_date_ur+'</p></div>');
                        }
                    } else {
                        var lastMsgDt = moment.utc(chat_user.last_message.display_date, "YYYY-MM-DD'T'HH:mm:ss.SSSSSS'Z'").toDate();
                        var lastMsg_date = moment(lastMsgDt).format('DD-MMM-YYYY');
                        var now_date_ur = moment().format('DD-MMM-YYYY');
                        if (lastMsg_date != now_date_ur) {
                            var pre_dt_ur = $(".lst_ur_msg_dt").text();
                            if (pre_dt_ur != now_date_ur) {
                                $(".msg_card_body").append('<div class="d-flex justify-content-center"><p class="lst_ur_msg_dt">'+now_date_ur+'</p></div>');
                            }
                        }
                    }
                    $('#chat_user_messages_count').text(Number($('#chat_user_messages_count').text()) + 1);
                    // $(".msg_card_body").append($.tmpl($("#jsSelfTemplate").html(), lstRows));
                    appendReceivedMessageForOtherUser(lstRows);
                    console.log('what is this');
                } else {
                    $('#chat-user-'+msg.from+'').find('p.user_last_msg').text(decode_message);
                    let cont = $('#user_msg_' + msg.from).html();
                    if (cont == '' || cont == null || cont == 'undefined' || isNaN(cont)) {
                        cont = 0;
                    }
                    cont = parseInt(cont) + 1;
                    $('#user_msg_' + msg.from).html(cont);
                }
            } else if (msg.from == chat_user.id) {
                
                console.log('show chat message for other user');
                let rowRes = [];
                var lstRows = new Array();
                rowRes.message = msg.message;
                if (from_user.id == msg.from) {
                    rowRes.profile_photo_path = msg.from_user_profile_url;
                } else {
                    rowRes.profile_photo_path = msg.to_user_profile_url;
                }
                rowRes.time = moment().format('HH:mm');
                lstRows.push(rowRes);
                if (chat_user.last_message == '' || chat_user.last_message == null) {
                    var now_date_ur = moment().format('DD-MMM-YYYY');
                    var pre_dt_ur = $(".lst_ur_msg_dt").text();
                    if (pre_dt_ur != now_date_ur) {
                        $(".msg_card_body").append('<div class="d-flex justify-content-center"><p class="lst_ur_msg_dt">'+now_date_ur+'</p></div>');
                    }
                } else {
                    var lastMsgDt = moment.utc(chat_user.last_message.display_date, "YYYY-MM-DD'T'HH:mm:ss.SSSSSS'Z'").toDate();
                    var lastMsg_date = moment(lastMsgDt).format('DD-MMM-YYYY');
                    var now_date_ur = moment().format('DD-MMM-YYYY');
                    if (lastMsg_date != now_date_ur) {
                        var pre_dt_ur = $(".lst_ur_msg_dt").text();
                        if (pre_dt_ur != now_date_ur) {
                            $(".msg_card_body").append('<div class="d-flex justify-content-center"><p class="lst_ur_msg_dt">'+now_date_ur+'</p></div>');
                        }
                    }
                }
                $('#chat_user_messages_count').text(Number($('#chat_user_messages_count').text()) + 1);
                
                //appendUserchat(lstRows,'user',''); // arvind
                
                
                // <li class="clearfix">
                //     <div class="message user-message my-message">
                //         <div class="d-flex justify-content-start mb-2 chat_box position-relative">
                //             <div class="d-flex align-items-start gap-3">
                //                 <div class="contact-avatar">
                //                     <img src="undefined" alt="avatar" width="45" height="45" class="rounded-circle bg-primary">
                //                 </div>
                //                 <div class="msg_container">
                //                     <p class="mb-0">saassssssssssssssssssssss</p>
                //                 </div>
                //             </div>
                //             <span class="di__chat_time text-tiny mb-0 lst_ur_msg_dt">11:35</span>
                //         </div>
                //     </div>
                // </li>
                
                
                
                
                
                 /// arvind here
                
                // appendReceivedMessageForOtherUser(msg.message,msg.time_diff,msg.from_user_profile_url,'');
                
                appendReceivedMessageForOtherUser(lstRows);
        
            } else {
                let cont = $('#user_msg_' + msg.from).html();
                if (cont == '' || cont == null || cont == 'undefined' || isNaN(cont)) {
                    cont = 0;
                }
                cont = parseInt(cont) + 1;
                $('#user_msg_' + msg.from).html(cont);
            }
            $('#chat-user-'+msg.from+'').find('p.user_last_msg').text(decode_message);
            var first_user = $('#contact-list').find('#chat-user-'+msg.from+'');
            first_user.remove();
            $('#contact-list').prepend(first_user);
            });
        }
        
        $('.chat-history-main').stop().animate({
            scrollTop: $('.chat-history-main')[0].scrollHeight
        }, 1500);
        
        // $('#msg_card_body').stop().animate({
        //     scrollTop: $('#msg_card_body')[0].scrollHeight
        // }, 1500);
    } else {
        // console.log(chat_group);
        if (msg.documents != 'undefined' || msg.documents.length > 0) {
            $.each(msg.documents, function (index, doc) {
                let rowDocRes = [];
                var lstDocRows = new Array();
                rowDocRes.message = doc.document_url;
                rowDocRes.document_name = doc.document;
                rowDocRes.time = moment().format('HH:mm');
                rowDocRes.profile_photo_path = msg.from_user_profile_url;
                lstDocRows.push(rowDocRes);
                if (msg.from == from_user.id) {
                    if (msg.group_id == chat_group.id) {
                        $('#chat-group-'+chat_group.id+'').find('p.group_last_msg').text('You: '+ doc.document);
                        if (chat_group.last_message != '' || chat_group.last_message != null) {
                            var now_date_gp = moment().format('DD-MMM-YYYY');
                            var pre_dt_gp = $(".lst_gp_msg_dt").text();
                            if (pre_dt_gp != now_date_gp) {
                                $(".msg_card_body").append('<div class="d-flex justify-content-center"><p class="lst_gp_msg_dt">'+now_date_gp+'</p></div>');
                            }
                        } else {
                            var lastMsgDt = moment.utc(chat_group.last_message.display_date, "YYYY-MM-DD'T'HH:mm:ss.SSSSSS'Z'").toDate();
                            var lastMsg_date = moment(lastMsgDt).format('DD-MMM-YYYY');
                            var now_date_gp = moment().format('DD-MMM-YYYY');
                            if (lastMsg_date != now_date_gp) {
                                var pre_dt_gp = $(".lst_gp_msg_dt").text();
                                if (pre_dt_gp != now_date_gp) {
                                    $(".msg_card_body").append('<div class="d-flex justify-content-center"><p class="lst_gp_msg_dt">'+now_date_gp+'</p></div>');
                                }
                            }
                        }
                        $('#chat_user_messages_count').text(Number($('#chat_user_messages_count').text()) + 1);
                                          
                        console.log('its not calling',lstDocRows);
                        if (checkImage(rowDocRes.message)) {
                            appendUserchat(lstDocRows,'self','img','append','grp');
                        } else if (checkVideo(rowDocRes.message)) {
                            appendUserchat(lstDocRows,'self','video','append','grp');
                        } else if (checkAudio(rowDocRes.message)) {
                            appendUserchat(lstDocRows,'self','audio','append','grp');
                        } else {
                            appendUserchat(lstDocRows,'self','doc','append','grp');
                        }
                        
                        
                    } else {
                        $('#chat-group-'+msg.group_id+'').find('p.group_last_msg').text('You: '+ doc.document);
                        var cont = $('#group_msg_' + msg.group_id).html();
                        if (cont == '' || cont == null || cont == 'undefined' || isNaN(cont)) {
                            cont = 0;
                        }
                        cont = parseInt(cont) + 1;
                        $('#group_msg_' + msg.group_id).html(cont);
                    }
                } else if (chat_group != undefined) {
                    if (msg.group_id == chat_group.id) {
                        $('#chat_user_messages_count').text(Number($('#chat_user_messages_count').text()) + 1);
                        if (chat_group.last_message != '' || chat_group.last_message != null) {
                            var now_date_gp = moment().format('DD-MMM-YYYY');
                            var pre_dt_gp = $(".lst_gp_msg_dt").text();
                            if (pre_dt_gp != now_date_gp) {
                                $(".msg_card_body").append('<div class="d-flex justify-content-center"><p class="lst_gp_msg_dt">'+now_date_gp+'</p></div>');
                            }
                        } else {
                            var lastMsgDt = moment.utc(chat_group.last_message.display_date, "YYYY-MM-DD'T'HH:mm:ss.SSSSSS'Z'").toDate();
                            var lastMsg_date = moment(lastMsgDt).format('DD-MMM-YYYY');
                            var now_date_gp = moment().format('DD-MMM-YYYY');
                            if (lastMsg_date != now_date_gp) {
                                var pre_dt_gp = $(".lst_gp_msg_dt").text();
                                if (pre_dt_gp != now_date_gp) {
                                    $(".msg_card_body").append('<div class="d-flex justify-content-center"><p class="lst_gp_msg_dt">'+now_date_gp+'</p></div>');
                                }
                            }
                        }
                        console.log('its calling',lstDocRows);   //arvind here
                        
                        if (checkImage(rowDocRes.message)) {
                            appendReceivedMessageForOtherUser(lstDocRows,'img');
                            // appendUserchat(lstDocRows,'user','img','append',);
                        } else if (checkVideo(rowDocRes.message)) {
                            appendReceivedMessageForOtherUser(lstDocRows,'video');
                            // appendUserchat(lstDocRows,'user','video','append',);
                        } else if (checkAudio(rowDocRes.message)) {
                            appendReceivedMessageForOtherUser(lstDocRows,'audio');
                            // appendUserchat(lstDocRows,'user','audio','append',);
                        } else {
                            appendReceivedMessageForOtherUser(lstDocRows,'doc');
                            // appendUserchat(lstDocRows,'user','doc','append',);
                        }
                        
                    } else {
                        var cont = $('#group_msg_' + msg.group_id).html();
                        if (cont == '' || cont == null || cont == 'undefined' || isNaN(cont)) {
                            cont = 0;
                        }
                        cont = parseInt(cont) + 1;
                        $('#group_msg_' + msg.group_id).html(cont);
                    }
                } else {
                    var cont = $('#group_msg_' + msg.group_id).html();
                    if (cont == '' || cont == null || cont == 'undefined' || isNaN(cont)) {
                        cont = 0;
                    }
                    cont = parseInt(cont) + 1;
                    $('#group_msg_' + msg.group_id).html(cont);
                }
                var last_msg_user = getUserById(msg.from);
                $('#chat-group-'+msg.group_id+'').find('p.group_last_msg').text(last_msg_user.name +': '+ doc.document);
            });
            var first_user = $('#contact-list').find('#chat-group-'+msg.group_id+'');
            first_user.remove();
            $('#contact-list').prepend(first_user);
        }
        if (msg.message != '') {
            
            decodeString(msg.message, function(decode_message) {
            if (msg.from == from_user.id) {
                let rowRes = [];
                var lstRows = new Array();
                rowRes.message = decode_message;
                rowRes.profile_photo_path = msg.from_user_profile_url;
                rowRes.time = moment().format('HH:mm');
                lstRows.push(rowRes);
                if (msg.group_id == chat_group.id) {
                    $('#chat-group-'+chat_group.id+'').find('p.group_last_msg').text('You: '+ decode_message);
                    if (msg.message_type == 1) {
                        $(".msg_card_body").append('<div class="d-flex justify-content-center"><p>'+decode_message+'</p></div>');
                    } else {
                        if (chat_group.last_message != '' || chat_group.last_message != null) {
                            var now_date_gp = moment().format('DD-MMM-YYYY');
                            var pre_dt_gp = $(".lst_gp_msg_dt").text();
                            if (pre_dt_gp != now_date_gp) {
                                $(".msg_card_body").append('<div class="d-flex justify-content-center"><p class="lst_gp_msg_dt">'+now_date_gp+'</p></div>');
                            }
                        } else {
                            var lastMsgDt = moment.utc(chat_group.last_message.display_date, "YYYY-MM-DD'T'HH:mm:ss.SSSSSS'Z'").toDate();
                            var lastMsg_date = moment(lastMsgDt).format('DD-MMM-YYYY');
                            var now_date_gp = moment().format('DD-MMM-YYYY');
                            if (lastMsg_date != now_date_gp) {
                                var pre_dt_gp = $(".lst_gp_msg_dt").text();
                                if (pre_dt_gp != now_date_gp) {
                                    $(".msg_card_body").append('<div class="d-flex justify-content-center"><p class="lst_gp_msg_dt">'+now_date_gp+'</p></div>');
                                }
                            }
                        }
                        $('#chat_user_messages_count').text(Number($('#chat_user_messages_count').text()) + 1);
                        // $(".msg_card_body").append($.tmpl($("#jsSelfTemplate").html(), lstRows));
                        appendReceivedMessageForOtherUser(lstRows);
                    }
                } else {
                    $('#chat-group-'+msg.group_id+'').find('p.group_last_msg').text('You: '+ decode_message);
                    var cont = $('#group_msg_' + msg.group_id).html();
                    if (cont == '' || cont == null || cont == 'undefined' || isNaN(cont)) {
                        cont = 0;
                    }
                    cont = parseInt(cont) + 1;
                    $('#group_msg_' + msg.group_id).html(cont);
                }
            } else if (chat_group != undefined) {
                if (msg.group_id == chat_group.id) {
                    if (msg.message_type == 1) {
                        $(".msg_card_body").append('<div class="d-flex justify-content-center"><p>'+decode_message+'</p></div>');
                    } else {
                        let rowRes = [];
                        var lstRows = new Array();
                        rowRes.message = decode_message;
                        if (from_user.id == msg.from) {
                            rowRes.profile_photo_path = msg.from_user_profile_url;
                        } else {
                            rowRes.profile_photo_path = msg.to_user_profile_url;
                        }
                        rowRes.time = moment().format('HH:mm');
                        lstRows.push(rowRes);
                        if (chat_group.last_message != '' || chat_group.last_message != null) {
                            var now_date_gp = moment().format('DD-MMM-YYYY');
                            var pre_dt_gp = $(".lst_gp_msg_dt").text();
                            if (pre_dt_gp != now_date_gp) {
                                $(".msg_card_body").append('<div class="d-flex justify-content-center"><p class="lst_gp_msg_dt">'+now_date_gp+'</p></div>');
                            }
                        } else {
                            var lastMsgDt = moment.utc(chat_group.last_message.display_date, "YYYY-MM-DD'T'HH:mm:ss.SSSSSS'Z'").toDate();
                            var lastMsg_date = moment(lastMsgDt).format('DD-MMM-YYYY');
                            var now_date_gp = moment().format('DD-MMM-YYYY');
                            if (lastMsg_date != now_date_gp) {
                                var pre_dt_gp = $(".lst_gp_msg_dt").text();
                                if (pre_dt_gp != now_date_gp) {
                                    $(".msg_card_body").append('<div class="d-flex justify-content-center"><p class="lst_gp_msg_dt">'+now_date_gp+'</p></div>');
                                }
                            }
                        }
                        $('#chat_user_messages_count').text(Number($('#chat_user_messages_count').text()) + 1);
                        // appendUserchat(lstRows,'user','','append','grp');
                        appendReceivedMessageForOtherUser(lstRows);
                    }
                } else {
                    var cont = $('#group_msg_' + msg.group_id).html();
                    if (cont == '' || cont == null || cont == 'undefined' || isNaN(cont)) {
                        cont = 0;
                    }
                    cont = parseInt(cont) + 1;
                    $('#group_msg_' + msg.group_id).html(cont);
                }
            } else {
                var cont = $('#group_msg_' + msg.group_id).html();
                if (cont == '' || cont == null || cont == 'undefined' || isNaN(cont)) {
                    cont = 0;
                }
                cont = parseInt(cont) + 1;
                $('#group_msg_' + msg.group_id).html(cont);
            }
            var last_msg_user = getUserById(msg.from);
            $('#chat-group-'+msg.group_id+'').find('p.group_last_msg').text(last_msg_user.name +': '+ decode_message);
            var first_user = $('#contact-list').find('#chat-group-'+msg.group_id+'');
            first_user.remove();
            $('#contact-list').prepend(first_user);
            });
        }
        $('#msg_card_body').stop().animate({
            scrollTop: $('#msg_card_body')[0].scrollHeight
        }, 1500);
    }
// });
});

$(document).on('keyup', '#lm-search', function (e) {
    e.preventDefault();
    let term = $(this).val();
    $.each(users, function (index, value) {
        if (value.name.toLowerCase().trim().includes(term.toLowerCase().trim())) {
            $('#chat-user-' + value.id).removeClass('d-none');
        } else {
            $('#chat-user-' + value.id).addClass('d-none');
        }
    });
    // $.each(groups, function (index, value) {
    //     if (value.group_name.toLowerCase().trim().includes(term.toLowerCase().trim())) {
    //         $('#chat-group-' + value.id).removeClass('d-none');
    //     } else {
    //         $('#chat-group-' + value.id).addClass('d-none');
    //     }
    // });
    if ($('.chat-user').not('.d-none').length == 0) {
        $('.no_records_found').removeClass('d-none');
    } else if ($('.chat-group').not('.d-none').length == 0) {
        $('.no_records_found').removeClass('d-none');
    } else {
        $('.no_records_found').addClass('d-none');
    }
});

$(document).on('click', '#lm-search', function (e) {
    e.preventDefault();
    let term = $(this).val();
    $.each(users, function (index, value) {
        if (value.name.toLowerCase().trim().includes(term.toLowerCase().trim())) {
            $('#chat-user-' + value.id).removeClass('d-none');
        } else {
            $('#chat-user-' + value.id).addClass('d-none');
        }
    });
    // $.each(groups, function (index, value) {
    //     if (value.group_name.toLowerCase().trim().includes(term.toLowerCase().trim())) {
    //         $('#chat-group-' + value.id).removeClass('d-none');
    //     } else {
    //         $('#chat-group-' + value.id).addClass('d-none');
    //     }
    // });
    if ($('.chat-user').not('.d-none').length == 0) {
        $('.no_records_found').removeClass('d-none');
    } else if ($('.chat-group').not('.d-none').length == 0) {
        $('.no_records_found').removeClass('d-none');
    } else {
        $('.no_records_found').addClass('d-none');
    }
});
    
$(document).on('click', '.send_btn', function (e) {
    e.preventDefault();
    let message = $('#message').val();
    if (message.length > 0 && message.trim() != '') {
        var uuid = new Date().getTime() + from_user.id;
        var _message = message.replace(/\\/g, "\\\\");
        // if (chat_user == null || chat_user == '') {
        //     if (_message != '') {
        //         alert('1');
        //         encodeString(_message, function(encode_message) {
        //             socket.emit('vendorGroupMessage', { message: encode_message, message_type:0, from: from_user, send_group: chat_group, uuid: uuid });
        //         });
        //     } else {
        //         alert('2');
        //         socket.emit('vendorGroupMessage', { message: _message, message_type:0, from: from_user, send_group: chat_group, uuid: uuid });
        //     }
        //     // $('#chat-group-'+chat_group.id+'').find('p.group_last_msg').text('You: '+ message);
        // } else {
            if (_message != '') {
                console.log('chat_user = '+ chat_user.id);
                // encodeString(_message, function(encode_message) {
                    socket.emit('vendorMessage', { message: _message, from: from_user, send: chat_user, uuid: uuid });
            //     });
            } else {
                console.log('else: chat_user = '+ chat_user.id);
                socket.emit('vendorMessage', { message: _message, from: from_user, send: chat_user, uuid: uuid });
            }
            $('#chat-user-'+chat_user.id+'').find('p.user_last_msg').text(message);
        // }
        let rowRes = [];
        var lstRows = new Array();
        rowRes.message = message;
        rowRes.profile_photo_path = from_user.profile_url;
        rowRes.time = moment().format('HH:mm');
        lstRows.push(rowRes);
        
        
        
        if (chat_user == null || chat_user == '') {
            if (chat_group.last_message != '' || chat_group.last_message != null) {
                var now_date_gp = moment().format('DD-MMM-YYYY');
                var pre_dt_gp = $(".lst_gp_msg_dt").text();
                if (pre_dt_gp != now_date_gp) {
                    $(".msg_card_body").append('<div class="d-flex justify-content-center"><p class="lst_gp_msg_dt">'+now_date_gp+'</p></div>');
                }
            } else {
                var lastMsgDt = moment.utc(chat_group.last_message.display_date, "YYYY-MM-DD'T'HH:mm:ss.SSSSSS'Z'").toDate();
                var lastMsg_date = moment(lastMsgDt).format('DD-MMM-YYYY');
                var now_date_gp = moment().format('DD-MMM-YYYY');
                if (lastMsg_date != now_date_gp) {
                    var pre_dt_gp = $(".lst_gp_msg_dt").text();
                    if (pre_dt_gp != now_date_gp) {
                        $(".msg_card_body").append('<div class="d-flex justify-content-center"><p class="lst_gp_msg_dt">'+now_date_gp+'</p></div>');
                    }
                }
            }
        }
        else {
            if (chat_user.last_message == '' || chat_user.last_message == null) {
                var now_date_ur = moment().format('DD-MMM-YYYY');
                var pre_dt_ur = $(".lst_ur_msg_dt").text();
                if (pre_dt_ur != now_date_ur) {
                    $(".msg_card_body").append('<div class="d-flex justify-content-center"><p class="lst_ur_msg_dt">'+now_date_ur+'</p></div>');
                }
            } else {
                var lastMsgDt = moment.utc(chat_user.last_message.display_date, "YYYY-MM-DD'T'HH:mm:ss.SSSSSS'Z'").toDate();
                var lastMsg_date = moment(lastMsgDt).format('DD-MMM-YYYY');
                var now_date_ur = moment().format('DD-MMM-YYYY');
                if (lastMsg_date != now_date_ur) {
                    var pre_dt_ur = $(".lst_ur_msg_dt").text();
                    if (pre_dt_ur != now_date_ur) {
                        $(".msg_card_body").append('<div class="d-flex justify-content-center"><p class="lst_ur_msg_dt">'+now_date_ur+'</p></div>');
                    }
                }
            }
        }
        
        $('#chat_user_messages_count').text(Number($('#chat_user_messages_count').text()) + 1);
        
        
        var selfMessage = '<li class="clearfix"><div class="message my-message"><div class="d-flex justify-content-end mb-2 chat_box"><div class="msg_container"><div class="d-flex align-items-end gap-2"><p class="mb-0">'+message+'</p><span class="text-sm-10 mb-0">'+now_date_ur+'</span></div></div></div></div></li>';
        $(".msg_card_body").append(selfMessage);
        
        
        // console.log("selfMessage",selfMessage);
        $('#message').val('');
        $('#message').html('');
        // jsSelfTemplate
        if (chat_user == null || chat_user == '') {
            var first_user = $('#contact-list').find('#chat-group-'+chat_group.id+'');
        } else {
            var first_user = $('#contact-list').find('#chat-user-'+chat_user.id+'');
        }
        first_user.remove();
        $('#contact-list').prepend(first_user);
    }
    $('.chat-history-main').stop().animate({
        scrollTop: $('.chat-history-main')[0].scrollHeight
    }, 1500);
});

function getUserById($user_id)
{
    return users.filter(function (key, value) {
        return key.id == $user_id;
    })[0];
}

$('.chat-history-main').scroll(function(){
    if ($(this).scrollTop() == 0) {
        // console.log(chat_user.id);
        
        if (on_top == false) {
            if (processing == false) {
                page++;
                if (chat_user == null || chat_user == '') {
                    //getGroupChat(chat_group.id, page, true, false);
                } else {
                    getUserChat(chat_user.id, page, true, false);
                }
            }
        }
    }
});

function uploadFile(files) {
    var formData = new FormData();
    var error = 0;
    $.each(files, function (index, value) {
        if (value == 0 || value.size >= 25600000) {
            error = 1;
            // toastr.error('File size exceeds maximum limit 25 MB.');
            alert('File size exceeds maximum limit 25 MB.');
            return false;
        }
        formData.append('documents[]', value);
    });
    formData.append('_token', csrf_token);
    $.ajax({
        url: chat_store_media,
        type: 'POST',
        data: formData,
        global: false,
        contentType: false,
        processData: false,
        beforeSend : function(xhr, opts){
            if (error) {
                xhr.abort();
                return false;
            }
        },
        success: function(response) {
            let message = $('#message').val().trim();
            var uuid = new Date().getTime() + from_user.id;
            if (chat_user == null || chat_user == '') {
                // encodeString(message, function(encode_message) {
                    //socket.emit('vendorGroupMessage', { message: message, message_type:0, from: from_user, send_group: chat_group, uuid: uuid, documents : response.documents });
                // });
                //$('#chat-group-'+chat_group.id+'').find('p.group_last_msg').text(from_user.name +': '+ message);
            } else {
                // encodeString(message, function(encode_message) {
                    socket.emit('vendorMessage', { message: message, from: from_user, send: chat_user, uuid: uuid, documents : response.documents });
                    //socket.emit('vendorMessage', { message: _message, from: from_user, send: chat_user, uuid: uuid });
                // });
                $('#chat-user-'+chat_user.id+'').find('p.user_last_msg').text(message);
            }
            if (typeof response.documents !== 'undefined') {
                $.each(response.documents, function (index, document) {
                    
                    
                    let rowDocRes = [];
                    var lstDocRows = new Array();
                    rowDocRes.message = document.link;
                    rowDocRes.document_name = document.name;
                    rowDocRes.time = moment().format('HH:mm');
                    rowDocRes.profile_photo_path = from_user.profile_url;
                    lstDocRows.push(rowDocRes);
                                    
                    if (checkImage(rowDocRes.message)) {
                        appendUserchat(rowDocRes,'self','img','append');
                        // $(".msg_card_body").append($.tmpl($("#jsSelfImageTemplate").html(), lstDocRows));
                    } else if (checkVideo(rowDocRes.message)) {
                        appendUserchat(rowDocRes,'self','video','append');
                        // $(".msg_card_body").append($.tmpl($("#jsSelfVideoTemplate").html(), lstDocRows));
                    } else if (checkAudio(rowDocRes.message)) {
                        appendUserchat(rowDocRes,'self','audio','append');
                        // $(".msg_card_body").append($.tmpl($("#jsSelfAudioTemplate").html(), lstDocRows));
                    } else {      
                        appendUserchat(rowDocRes,'self','doc','append');
                        
                        //var selfMessage = '<li class="clearfix"><div class="message my-message"><div class="d-flex justify-content-end mb-2 chat_box"><div class="msg_container"><div class="d-flex align-items-end gap-2"><a href="'+lstDocRows[0].message+'" target="_blank"><p class="mb-0">'+lstDocRows[0].document_name+'</p></a><span class="text-sm-10 mb-0">'+lstDocRows[0].time+'</span></div></div></div></div></li>';
                       // $(".msg_card_body").append(selfMessage);
                        // $(".msg_card_body").append($.tmpl($("#jsSelfDocumentTemplate").html(), lstDocRows));
                    }
                    
                    
                    if (chat_user == null || chat_user == '') {
                        //$('#chat-group-'+chat_group.id+'').find('p.group_last_msg').text(from_user.name +': '+ document.name);
                    } else {
                        $('#chat-user-'+chat_user.id+'').find('p.user_last_msg').text(document.name);
                    }
                });
                $('#chat_user_messages_count').text(Number($('#chat_user_messages_count').text()) + 1);
            }
            if (message) {
                let rowRes = [];
                var lstRows = new Array();
                rowRes.message = message;
                rowRes.profile_photo_path = from_user.profile_url;
                rowRes.time = moment().format('HH:mm');
                var chat_time = moment().format('HH:mm');
                lstRows.push(rowRes);
               // $(".msg_card_body").append($.tmpl($("#jsSelfTemplate").html(), lstRows));
                
                var selfMessage = '<li class="clearfix"><div class="message my-message"><div class="d-flex justify-content-end mb-2 chat_box">';
                selfMessage += '<div class="msg_container"><div class="d-flex align-items-end gap-2"><p class="mb-0">'+message+'</p><span class="di__chat_time text-tiny mb-0 lst_ur_msg_dt">'+chat_time+'</span></div></div></div></div></li>';
                $(".msg_card_body").append(selfMessage);
            
                $('#message').val('');
                if (chat_user == null || chat_user == '') {
                    $('#chat-group-'+chat_group.id+'').find('p.group_last_msg').text(from_user.name +': '+ message);
                } else {
                    $('#chat-user-'+chat_user.id+'').find('p.user_last_msg').text(message);
                }
                $('#chat_user_messages_count').text(Number($('#chat_user_messages_count').text()) + 1);
            }
            $('#msg_card_body').stop().animate({
                scrollTop: $('#msg_card_body')[0].scrollHeight
            }, 1500);
        },
        error: function (response) {
            if (response.status == 422) {
                $.each(response.responseJSON.errors, function (index, value) {
                    //toastr.error(value);
                    alert('Error:'+value);
                });
            } else {
                //toastr.error("Something Went Wrong !");
                alert('Error: Something Went Wrong !');
            }
        }
    });
}

$(document).on('change', '#imageUpload', function() {
    if (this.files.length <= 10) {
        uploadFile(this.files);
    } else {
       // toastr.error('Max 10 Files upload at a time');
        alert('Max 10 Files upload at a time');
    }
});

function checkImage(url) {
	return(url.match(/\.(jpeg|jpg|gif|png|jfif)$/) != null);
}

function checkVideo(url) {
	return(url.match(/\.(mp4|avi|mkv)$/) != null);
}

function checkAudio(url) {
	return(url.match(/\.(mp3|wav|ogg)$/) != null);
}


function getUserChat(user_id, page = 1, from_scroll = false, user_change = true)
{
    $('#message').prop('disabled', true);
    $('#user_msg_' + user_id).html('');
    if (user_change) {
        $(".msg_card_body").html('');
    }
    let url = chat_user_route;
        url = url.replace(':id', user_id);
    $.ajax({
        url: url,
        method: 'GET',
        data: { page: page },
        beforeSend: function (response) {
            processing = true;
        },
        success: function (response) {
            
            
            // $('#chat_user_messages_count').html(response.total);
            if (typeof response.paginate_data != 'undefined') {
                var data = response.paginate_data;
            } else {
                var data = response.data;
            }
            var chat_date = '';
            
            

            $.each(data, function (key, value) {
                
                var chat_time = value.display_time;
                var toDt = moment.utc(value.created_at, "YYYY-MM-DD'T'HH:mm:ss.SSSSSS'Z'").toDate();
                var chat_date_pre = chat_date;
                chat_date = moment(toDt).format('DD-MMM-YYYY');
                if (chat_date != chat_date_pre) {
                    if (chat_date_pre != '') {
                        if (chat_date_pre == moment().format('DD-MMM-YYYY')) {
                            $(".msg_card_body").prepend('<div class="d-flex justify-content-center"><p class="lst_ur_msg_dt">'+chat_date_pre+'</p></div>');
                        } else {
                            $(".msg_card_body").prepend('<div class="d-flex justify-content-center"><p>'+chat_date_pre+'</p></div>');
                        }
                    }
                }
                

                if (typeof value.documents !== 'undefined') {
                    $.each(value.documents, function (index, document) {
                        let rowDocRes = [];
                        var lstDocRows = new Array();
                        rowDocRes.message = document.document_url;
                        rowDocRes.document_name = document.document;
                        rowDocRes.time = chat_time;
                        rowDocRes.profile_photo_path = '';
                        //value.vendor.profile_url
                        lstDocRows.push(rowDocRes);
                        
                        // console.log("Arvind testing onload img attached file: ",rowDocRes);
                        
                        if (value.from == from_user.id) {
                            if (checkImage(rowDocRes.message)) {
                                appendUserchat(rowDocRes,'self','img');
                            } else if (checkVideo(rowDocRes.message)) {
                                appendUserchat(rowDocRes,'self','video');
                            } else if (checkAudio(rowDocRes.message)) {
                                appendUserchat(rowDocRes,'self','audio');
                            } else {
                                appendUserchat(rowDocRes,'self','doc');        
                            }
                        } else {
                            
                            if (checkImage(rowDocRes.message)) {
                                appendUserchat(rowDocRes,'user','img');
                            } else if (checkVideo(rowDocRes.message)) {
                                appendUserchat(rowDocRes,'user','video');
                            } else if (checkAudio(rowDocRes.message)) {
                                appendUserchat(rowDocRes,'user','audio');
                            } else {
                                appendUserchat(rowDocRes,'user','doc');        
                            }
                        }
                    });
                }
                
                // console.log(value);
                
                if (value.message != '') {
                    let rowRes = [];
                    var lstRows = new Array();
                    rowRes.message = value.decrypted_msg;
                    rowRes.time = chat_time;
                    rowRes.profile_photo_path = '';
                    lstRows.push(rowRes);
                    if (value.from == from_user.id) {
                        // $(".msg_card_body").prepend(lstRows);
                        
                        var selfMessage = '<li class="clearfix"><div class="message my-message"><div class="d-flex justify-content-end mb-2 chat_box"><div class="msg_container"><div class="d-flex align-items-end gap-2"><p class="mb-0">'+value.message+'</p><span class="text-sm-10 mb-0">'+value.display_time+'</span></div></div></div></div></li>';
                        $(".msg_card_body").prepend(selfMessage);
        
        
                    } else {
                        // $(".msg_card_body").prepend(lstRows);
                        
                        var OtherMessage = '<li class="clearfix"><div class="message other-message"><div class="d-flex justify-content-start mb-2 chat_box gap-2"><div class="msg_container"><div class="d-flex align-items-end gap-2"><p class="mb-0">'+value.message+'</p><span class="text-sm-10 mb-0 lst_ur_msg_dt">'+value.display_time+'</span></div></div></div></div></li>';
                        $(".msg_card_body").prepend(OtherMessage);
            
                    }
                }
                if (data.length - 1 == key) {
                    if (chat_date == moment().format('DD-MMM-YYYY')) {
                        $(".msg_card_body").prepend('<div class="d-flex justify-content-center"><p class="lst_ur_msg_dt">'+chat_date+'</p></div>');
                    } else {
                        $(".msg_card_body").prepend('<div class="d-flex justify-content-center"><p>'+chat_date+'</p></div>');
                    }
                }
                
                
                
               
            });
            if (response.current_page >= response.last_page) {
                on_top = true;
            }
            if (from_scroll) {
                $('.chat-history-main').scrollTop(0);
            } else {
                $('.chat-history-main').scrollTop($('.chat-history-main')[0].scrollHeight);
            }
            
            $('#message').prop('disabled', false);
            
        },
        complete: function (response) {
            $('#message').prop('disabled', false);
            processing = false;
        }
    });
}

function encodeString(string, callback)
{
    var url = encode_string_url;
    $.ajax({
        type: 'POST',
        url: url,
        dataType: "json",
        data: {
            _token: csrf_token,
            string: string
        },
        success: function (response) {
            callback(response.data.string);
        }
    });
}

function decodeString(string, callback)
{
    var url = decode_string_url;
    $.ajax({
        type: 'POST',
        url: url,
        dataType: "json",
        data: {
            _token: csrf_token,
            string: string
        },
        success: function (response) {
            callback(response.data.string);
        }
    });
}

function appendReceivedMessageForOtherUser(chat_data,display_type='',append_type='append')
{
    
    var chat_data = chat_data[0];
    
    if(display_type == 'doc')
    {
        var Message = '<li class="clearfix"><div class="message other-message"><div class="d-flex justify-content-start mb-2 chat_box gap-2">';
        Message +='<div class="d-flex align-items-start gap-3">';
        //Message +='<div class="contact-avatar"><img src="'+chat_data.profile_photo_path+'" alt="avatar" width="45" height="45" class="rounded-circle bg-primary"></div>';
        Message += '<div class="msg_container"><a href="'+chat_data.message+'" target="_blank"><p class="mb-0">'+chat_data.message+'</p></a></div>';
        Message += '</div>';
        Message += '<span class="di__chat_time text-tiny mb-0 lst_ur_msg_dt">'+chat_data.time+'</span>';
        Message += '</div></div></li>';
        //$(".msg_card_body").append(Message);
        
    } else if(display_type == 'img') {  
        var Message = '<li class="clearfix"><div class="message other-message"><div class="d-flex justify-content-start mb-2 chat_box gap-2">';
        Message +='<div class="d-flex align-items-start gap-3">';
        //Message +='<div class="contact-avatar"><img src="'+chat_data.profile_photo_path+'" alt="avatar" width="45" height="45" class="rounded-circle bg-primary"></div>';
        Message += '<div class="msg_container"><a href="'+chat_data.message+'" target="_blank"><p class="mb-0"><img class="chat_image" width="200px;" height="200px;" src="'+chat_data.message+'"></img></p></a></div>';
        Message += '</div>';
        Message += '<span class="di__chat_time text-tiny mb-0 lst_ur_msg_dt">'+chat_data.time+'</span>';
        Message += '</div></div></li>';
        //$(".msg_card_body").append(Message);
    }
    else if(display_type == 'audio') {
        var Message = '<li class="clearfix"><div class="message other-message"><div class="d-flex justify-content-start mb-2 chat_box gap-2">';
        Message +='<div class="d-flex align-items-start gap-3">';
        //Message +='<div class="contact-avatar"><img src="'+chat_data.profile_photo_path+'" alt="avatar" width="45" height="45" class="rounded-circle bg-primary"></div>';
        Message += '<div class="msg_container"><a href="'+chat_data.message+'" target="_blank"><p class="mb-0"><audio class="" src="'+chat_data.message+'" controls crossorigin></audio></p></a></div>';
        Message += '</div>';
        Message += '<span class="di__chat_time text-tiny mb-0 lst_ur_msg_dt">'+chat_data.time+'</span>';
        Message += '</div></div></li>';
        //$(".msg_card_body").append(Message);
    }
    else if(display_type == 'video') {
        var Message = '<li class="clearfix"><div class="message other-message"><div class="d-flex justify-content-start mb-2 chat_box gap-2">';
        Message +='<div class="d-flex align-items-start gap-3">';
        //Message +='<div class="contact-avatar"><img src="'+chat_data.profile_photo_path+'" alt="avatar" width="45" height="45" class="rounded-circle bg-primary"></div>';
        Message += '<div class="msg_container"><a href="'+chat_data.message+'" target="_blank"><p class="mb-0"><video class="chat_image" src="'+chat_data.message+'" controls crossorigin></video></p></a></div>';
        Message += '</div>';
        Message += '<span class="di__chat_time text-tiny mb-0 lst_ur_msg_dt">'+chat_data.time+'</span>';
        Message += '</div></div></li>';
        //$(".msg_card_body").append(Message);
    }
    else{
        // var Message = '<li class="clearfix"><div class="message user-message my-message"><div class="d-flex justify-content-start mb-2 chat_box position-relative">';
        // Message +='<div class="d-flex align-items-start gap-3">';
        // Message +='<div class="contact-avatar"><img src="'+chat_data.profile_photo_path+'" alt="avatar" width="45" height="45" class="rounded-circle bg-primary"></div>';
        // Message += '<div class="msg_container"><p class="mb-0">'+chat_data.message+'</p></div>';
        // Message += '</div>';
        // Message += '<span class="di__chat_time text-tiny mb-0 lst_ur_msg_dt">'+chat_data.time+'</span>';
        // Message += '</div></div></li>';
        
        var Message = '<li class="clearfix"><div class="message other-message">';
                Message +='<div class="d-flex justify-content-start mb-2 chat_box gap-2">';
                    Message +='<div class="msg_container">';
                        Message +='<div class="d-flex align-items-end gap-2">';
                            Message +='<p class="mb-0">'+chat_data.message+'</p>';
                            Message +='<span class="text-sm-10 mb-0 lst_ur_msg_dt">'+chat_data.time+'</span>';
                        Message +='</div>';
                    Message +='</div>';
                Message +='</div>';
            Message +='</div>';
        Message +='</li>';
        
        //$(".msg_card_body").append(Message);
    }
    if(append_type=='prepend')
    {
        $(".msg_card_body").prepend(Message);
    }
    else{
        $(".msg_card_body").append(Message);
    }
    
}
function appendUserchat(chat_data,display_type,doc_type='',renderType='prepend',chat_type='')
{
    
    if(chat_type == 'grp'){
        var chat_data = chat_data[0];
    }
    
    // console.log("chat_data = ",chat_data);
    // var chat_time = chat_data.time;
    if(display_type=='self')
    {
        if(doc_type == 'doc')
        {
            var selfMessage = '<li class="clearfix"><div class="message my-message"><div class="d-flex justify-content-end mb-2 chat_box">';
            selfMessage += '<div class="msg_container"><div class="d-flex align-items-end gap-2"><a href="'+chat_data.message+'" target="_blank"><p class="mb-0">'+chat_data.message+'</p></a><span class="di__chat_time text-tiny mb-0 lst_ur_msg_dt">'+chat_data.time+'</span></div></div></div></div></li>';
            // $(".msg_card_body").prepend(selfMessage);
        }
        else if(doc_type == "img")
        {
            var selfMessage = '<li class="clearfix"><div class="message my-message"><div class="d-flex justify-content-end mb-2 chat_box">';
            selfMessage += '<div class="msg_container"><div class="d-flex align-items-end gap-2"><a href="'+chat_data.message+'" target="_blank"><p class="mb-0"><img class="chat_image" width="200px;" height="200px;" src="'+chat_data.message+'"></img></p></a><span class="di__chat_time text-tiny mb-0 lst_ur_msg_dt">'+chat_data.time+'</span></div></div></div></div></li>';
            // $(".msg_card_body").append(selfMessage);
        }else if(doc_type == "audio")
        {
            var selfMessage = '<li class="clearfix"><div class="message my-message"><div class="d-flex justify-content-end mb-2 chat_box">';
            selfMessage += '<div class="msg_container"><div class="d-flex align-items-end gap-2"><a href="'+chat_data.message+'" target="_blank"><p class="mb-0"><audio class="" src="'+chat_data.message+'" controls crossorigin></audio></p></a><span class="di__chat_time text-tiny mb-0 lst_ur_msg_dt">'+chat_data.time+'</span></div></div></div></div></li>';
            // $(".msg_card_body").prepend(selfMessage);
        }
        else if(doc_type == "video")
        {
            var selfMessage = '<li class="clearfix"><div class="message my-message"><div class="d-flex justify-content-end mb-2 chat_box">';
            selfMessage += '<div class="msg_container"><div class="d-flex align-items-end gap-2"><a href="'+chat_data.message+'" target="_blank"><p class="mb-0"><video class="chat_image" src="'+chat_data.message+'" controls crossorigin></video></p></a><span class="di__chat_time text-tiny mb-0 lst_ur_msg_dt">'+chat_data.time+'</span></div></div></div></div></li>';
            // $(".msg_card_body").prepend(selfMessage);
        }
        else
        {
            var selfMessage = '<li class="clearfix"><div class="message my-message"><div class="d-flex justify-content-end mb-2 chat_box">';
            selfMessage += '<div class="msg_container"><div class="d-flex align-items-end gap-2"><p class="mb-0">'+chat_data.message+'</p><span class="di__chat_time text-tiny mb-0 lst_ur_msg_dt">'+chat_data.time+'</span></div></div></div></div></li>';
            // $(".msg_card_body").prepend(selfMessage);
        }
        if(renderType=='append')
        {
            $(".msg_card_body").append(selfMessage);
        }
        else
        {
            $(".msg_card_body").prepend(selfMessage);
        }
    }
    
    if(display_type=='user')
    {
        if(doc_type == 'doc')
        {
            var selfMessage = '<li class="clearfix"><div class="message other-message"><div class="d-flex justify-content-start mb-2 chat_box gap-2">';
            selfMessage += '<div class="msg_container"><div class="d-flex align-items-end gap-2"><a href="'+chat_data.message+'" target="_blank"><p class="mb-0">'+chat_data.message+'</p></a><span class="di__chat_time text-tiny mb-0 lst_ur_msg_dt">'+chat_data.time+'</span></div></div></div></div></li>';
            // $(".msg_card_body").prepend(selfMessage);
        }
        else if(doc_type == "img")
        {
            var selfMessage = '<li class="clearfix"><div class="message other-message"><div class="d-flex justify-content-start mb-2 chat_box gap-2">';
            selfMessage += '<div class="msg_container"><div class="d-flex align-items-end gap-2"><a href="'+chat_data.message+'" target="_blank"><p class="mb-0"><img class="chat_image" width="200px;" height="200px;"  src="'+chat_data.message+'"></img></p></a><span class="di__chat_time text-tiny mb-0 lst_ur_msg_dt">'+chat_data.time+'</span></div></div></div></div></li>';
            // $(".msg_card_body").prepend(selfMessage);
        }else if(doc_type == "audio")
        {
            var selfMessage = '<li class="clearfix"><div class="message other-message"><div class="d-flex justify-content-start mb-2 chat_box gap-2">';
            selfMessage += '<div class="msg_container"><div class="d-flex align-items-end gap-2"><a href="'+chat_data.message+'" target="_blank"><p class="mb-0"><audio class="" src="'+chat_data.message+'" controls crossorigin></audio></p></a><span class="di__chat_time text-tiny mb-0 lst_ur_msg_dt">'+chat_data.time+'</span></div></div></div></div></li>';
            // $(".msg_card_body").prepend(selfMessage);
        }
        else if(doc_type == "video")
        {
            var selfMessage = '<li class="clearfix"><div class="message other-message"><div class="d-flex justify-content-start mb-2 chat_box gap-2">';
            selfMessage += '<div class="msg_container"><div class="d-flex align-items-end gap-2"><a href="'+chat_data.message+'" target="_blank"><p class="mb-0"><video class="chat_image" src="'+chat_data.message+'" controls crossorigin></video></p></a><span class="di__chat_time text-tiny mb-0 lst_ur_msg_dt">'+chat_data.time+'</span></div></div></div></div></li>';
            // $(".msg_card_body").prepend(selfMessage);
        }
        else
        {
            var selfMessage = '<li class="clearfix"><div class="message other-message my-message"><div class="d-flex justify-content-start mb-2 chat_box gap-2">';
            selfMessage +='<div class="d-flex align-items-start gap-3">';
            selfMessage +='<div class="contact-avatar"><img src="'+chat_data.profile_photo_path+'" alt="avatar" width="45" height="45" class="rounded-circle bg-primary"></div>';
            selfMessage += '<div class="msg_container"><p class="mb-0">'+chat_data.message+'</p></div>';
            selfMessage += '</div>';
            selfMessage += '<span class="di__chat_time text-tiny mb-0 lst_ur_msg_dt">'+chat_data.time+'</span>';
            selfMessage += '</div></div></li>';
            
        
        
            // var selfMessage = '<li class="clearfix"><div class="message user-message"><div class="d-flex justify-content-start mb-2 chat_box position-relative">';
            // selfMessage += '<div class="msg_container"><div class="d-flex align-items-end gap-2"><p class="mb-0">'+chat_data.message+'</p><span class="di__chat_time text-tiny mb-0 lst_ur_msg_dt">'+chat_data.time+'</span></div></div></div></div></li>';
        }
        if(renderType=='append')
        {
            $(".msg_card_body").append(selfMessage);
        }
        else
        {
            $(".msg_card_body").prepend(selfMessage);
        }
    }
}

