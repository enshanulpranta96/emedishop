// function getServices() {
//     axios.get('/getservices').then(resp => {
//         if(resp.status == 200){
//         let data = resp.data;
//         $('#mainDiv').removeClass('d-none');
//         $('#loadingDiv').addClass('d-none');

//         //to avoid duplicate table 
//         // $('#serviceTable').empty();
//         $('#example').DataTable().destroy();
//         $('#serviceTable').empty();

//         $.each(data, function(i, item) {
//             $('<tr>').html(
//                 "<td><img style='width: 50px;' src='" + data[i].service_img + "' alt=''></td>" +
//                 "<td>" + data[i].service_name + "</td>" +
//                 "<td>" + data[i].service_desc + "</td>" +
//                 "<td><a class='btn btn-outline-primary' onclick='editformalt("+ data[i].id+")'>Edit</a></td>" +
//                 '<td><button class="btn btn-outline-danger" onclick="dltalt('+ data[i].id+')">Delete</button></td>'
//             ).appendTo('#serviceTable');
//         });

//          //adding table js
//          $('.tbl').attr('id', 'example');
//          $(document).ready(function() {
//              $('#example').DataTable();
//          });
//     } else {
//         $('#loadingDiv').addClass('d-none');
//         $('#wrongDiv').removeClass('d-none');
//     }

//     }).catch(error => {
//         $('#loadingDiv').addClass('d-none');
//         $('#wrongDiv').removeClass('d-none');
//         console.error(error);
//     });

// }

// if($("#url input[type='radio']:checked")){
//     $('#url').css('display','block');
//     $('#upload').css('display','none');
// }

// if($("#upload input[type='radio']:checked")){
//     $('#url').css('display','none');
//     $('#upload').css('display','block');
// }