<!DOCTYPE html>
<html>
<head>
<style>

</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/timer.jquery/0.7.0/timer.jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css"></script>
<link rel="stylesheet" href="./style.css"></script>
</head>
<body>
  <!-- =============================== HTML =============================== -->
<div id="display_content">
  <div id="secret" >
    <input type="text" name="Audio" value="alarm.mp3" id="change_audio"><br>
    <input type="text" name="s" value="2" size="2">s
  </div>
<div id="timer">TIMER</div>
<br>
<div id="my_input">

Task:
<input type="text" name="task" placeholder=""="task" id="task" style="width:300px"><br>
Time:
<input type="text" name="h" value="0" size="2">h
<input type="text" name="m" value="0" size="2">m <br>
<!-- <input type="text" name="s" value="2" size="2">s -->

<div id="myButtons">
<input type="button" id="add_task" value="New task">
<input type="button" id="pause" value="Pause">
<input type="button" id="resume" value="Resume"><br>
</div>
</div>
<br>
<table id="task_list">
  <colgroup>
    <col span="1" style="width:10%">
    <col span="1" style="width:90%">
  </colgroup>
  <tr>
    <th>Current</th>
    <th>Task</th>
  </tr>
  <tr>
    <td id="current_time"></td>
    <td id="current_task"></td>
  </tr>
  <tr>
    <th>Time</th>
    <th>Task</th>
  </tr>
</table>
</div>

<!-- ============================= JAVASCRIPT ============================= -->
<script type="text/javascript">
function MyTime(h,m,s){
  this.h=h;
  this.m=m;
  this.s=s;
  this.string=this.h+"h"+this.m+"m"+this.s+"s";
  this.display_string=this.h+":"+this.m;
  this.is_zero = function(){
    if(Number(h)==0 && Number(m)==0 && Number(s)==0 ){
      return true;
    } else {
      return false;
    }
  }
}
function GetTime(){
  current_time=new MyTime($("input[name=h]").val(),$("input[name=m]").val(),$("input[name=s]").val())
}
function ParseTimerTime(){
  var seconds=$("#timer").data('seconds');
  if (seconds){
    var s=seconds%60;
    var m=(seconds-s)/60;
    var h=0
    if (m>=60){
      h = m;
      m = m%60;
      h = (h-m)/60;
    }
    console.log(h);
    console.log(m);
    console.log(s);
    woop = new MyTime(h.toString(),m.toString(),s.toString());
    return woop;
  } else {
    return false;
  }

}
function SetTime(MyTime){
  console.log("run MyTime");
  $("input[name=h]").val(MyTime.h);
  $("input[name=m]").val(MyTime.m);
  $("input[name=s]").val(MyTime.s);
}
function AddTime(MyTime1,MyTime2){
  var minutes=0;
  var hours=0;
  if(Number(MyTime1.m)+Number(MyTime2.m)>=60){
    minutes=(Number(MyTime1.m)+Number(MyTime2.m))%60;
    hours=Math.floor((Number(MyTime1.m)+Number(MyTime2.m))/60);
  } else {
    minutes=(Number(MyTime1.m)+Number(MyTime2.m));
  }
  hours+=(Number(MyTime1.h)+Number(MyTime2.h));
  var Time=new MyTime(hours.toString(),minutes.toString(),'0');
  console.log(Time);
  return Time;
}
function SubtractTime(MyTime1,MyTime2){
  var minutes=0;
  var hours=0;
  if(Number(MyTime1.m)-Number(MyTime2.m)<0){
    minutes=Number(MyTime1.m)-Number(MyTime2.m)+60;
    hours=-1;
  } else {
    minutes=Number(MyTime1.m)-Number(MyTime2.m);
  }
  hours+=(Number(MyTime1.h)-Number(MyTime2.h));
  if (hours<0){
    console.log("error: time1<time2 in SubtractTime(..,..)");
    return
}
  var Time=new MyTime(hours.toString(),minutes.toString(),'0');
  console.log(Time);
  return Time;
}

var current_task
var current_time=new MyTime('0','0','0');
var alarm=new Audio('alarm.mp3');
var newTask= function(){
  var waiting_time=300000;
  $("#timer").timer('remove');
  alarm.play();
  swal({
    title: "Time's up!",
    text: "Continue task?",
    showCancelButton: true,
    confirmButtonColor: '#809fff',
    cancelButtonColor: '#ff80b3',
    confirmButtonText: 'Continue!',
    cancelButtonText: 'New Task!',
    confirmButtonClass: 'btn btn-success',
    cancelButtonClass: 'btn btn-danger',
    allowOutsideClick: false,
    buttonsStyling: true,
    timer: waiting_time,
  }).then(function () {
    alarm.pause();
    alarm.load();
    swal({
      title:"Continue Task",
      text:"duration:",
      input:'text',
      inputPlaceholder:'minutes',
      allowOutsideClick: false,
      timer: waiting_time,
      inputValidator: function (value) {
        return new Promise(function (resolve, reject) {
          if (Number(value) && Number.isInteger(Number(value)) && Number(value) <= 60) {
            resolve()
          } else {
            reject('has to be a number less than 60!')
          }
        })
      }
    }).then(function(text){
      var cont_time=new MyTime('0',text,'0')
      current_time=AddTime(current_time,cont_time);
      StartTimer(text+'m')
    },function(dismiss) {
      if (dismiss === "timer"){
        newTask()
      }
    })
  }, function (dismiss) {
    // dismiss can be 'cancel', 'overlay',
    // 'close', and 'timer'
    if (dismiss === 'cancel') {
      alarm.pause();
      alarm.load();
      UpdateTable();
      swal({
        title:"New Task",
        text:"Task:",
        input:'text',
        inputPlaceholder:'Task',
        allowOutsideClick: false,
        timer: waiting_time,
        inputValidator: function (value) {
          return new Promise(function (resolve, reject) {
            if (value) {
              resolve()
            } else {
              reject('Input a new task!')
            }
          })
        }
      }).then(function(text){
        $("#task").val(text);
        current_task=text;
        swal({
          title:"New Task",
          text:"duration:",
          input:'text',
          inputPlaceholder:'minutes',
          allowOutsideClick: false,
          timer: waiting_time,
          inputValidator: function (value) {
            return new Promise(function (resolve, reject) {
              if (Number(value) && Number.isInteger(Number(value)) && Number(value) <= 60) {
                resolve()
              } else {
                reject('has to be an integer less than 60!')
              }
            })
          }
        }).then(function(text){
          current_time=new MyTime('0',text,'0');
          SetTime(current_time);
          $("#add_task").click();
        },function(dismiss) {
          console.log("dismiss func woop is ran ");
          if (dismiss === "timer"){
            newTask()
          }
        })
      },function(dismiss) {
        if (dismiss === "timer"){
          newTask()
        }
      })
    } else if (dismiss==="timer"){
      newTask();
    }

  })
}
function StartTimer(time_string){
  $("#current_time").text(current_time.display_string);
  $("#current_task").text(current_task);
  $("#timer").timer('remove');
  $("#timer").timer({
    countdown: true,
    duration: time_string,	// The time to countdown from. `seconds` and `duration` are mutually exclusive
    format:		"%h:%M:%S",	// Format to show time in
    callback: newTask,
    repeat: false
  });
}

$(document).ready(function(){
  //test
  $("#add_task").click(function(){
    // change current_task, store in table
    var timer_time = ParseTimerTime();
    if (timer_time){
      current_time = SubtractTime(current_time,timer_time);
      UpdateTable();
    }
    // update current_task
    current_task=$("input[name=task]").val();
    GetTime();
    StartTimer(current_time.string);
  })
  $("#pause").click(function(){
    $("#timer").timer('pause');
  })
  $("#resume").click(function(){
    $("#timer").timer('resume');
  })
  // window.onbeforeunload = function() {
  //   return "no!"
  // };
});
function UpdateTable(){
  $("#task_list").append('<tr><td>'+current_time.display_string+'</td><td>'+current_task+"</td></tr>");
}

</script>
</body>
</html>
