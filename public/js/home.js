                                        /***********************************/
                                        /* STUFF FOR THE QUIZ SCORE GRAPH */
                                        /*********************************/
// AJAX Request to retrive scores from database - inserts into an array
function getData(){
    var arr = [];
    var arr2 = [];
    var arr3 = [];
    $.ajax({
        url: 'retrieveScores',
        method: 'GET',
        dataType: 'json',
        async: false,
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data){
            var htmlArr = data[0];
            var cssArr = data[1];
            var jsArr = data[2];

            for(var i in htmlArr)
                arr.push(htmlArr[i].score*100);
            var scoreArr = arr;

            for(var j in cssArr)
                arr2.push(cssArr[j].score*100);
            var scoreArr2 = arr2;

            for(var k in jsArr)
                arr3.push(jsArr[k].score*100);
            var scoreArr3 = arr3;
            
            loadData(scoreArr, scoreArr2, scoreArr3);
        },
        error: function(res){
            console.log('Error - Ajax Failed: ');
            console.log(res);
        }
    });
}
getData();
var htmlScores, cssScores, javascriptScores;
// Callback function for ajax request on quiz scores
function loadData(param, param2, param3){
    htmlScores = param;
    cssScores = param2;
    javascriptScores = param3;
}

var quizScores = document.getElementById('quizScores').getContext('2d');
var myLineChart = new Chart(quizScores, {
    'type': 'line',
    'data': {
        'labels': ['Quiz 1', 'Quiz 2', 'Quiz 3', 'Quiz 4', 'Quiz 5'],
        'datasets': [
            {
                'label': 'HTML Score',
                'data': htmlScores,
                'fill': false,
                'borderColor': 'rgba(255, 99, 132, 0.7)',
                'lineTension': 0.1
            },
            {
                'label': 'CSS Score',
                'data': cssScores,
                'fill': false,
                'borderColor': 'rgba(255, 206, 86, 0.7)',
                'lineTension': 0.1
            },
            {
                'label': 'JavaScript Score',
                'data': javascriptScores,
                'fill': false,
                'borderColor': 'rgba(153, 102, 255, 0.7)',
                'lineTension': 0.1
            }
        ]
    },
    options: {
        scales: {
            yAxes: [{
                display: true,
                ticks: {
                    suggestedMin: 0,    // minimum will be 0, unless there is a lower value.
                    // OR //
                    beginAtZero: true   // minimum value will be 0.
                }
            }]
        }
    }
})
//});

                                          /*********************************/
                                         /* STUFF FOR THE TOP THREE BOXES  /
                                        /*     and PROGRESS BAR           /
                                       /*********************************/
// Display lessons completed  on progress bar
document.getElementById("html-progress").value = htmlScores.length;
document.getElementById("css-progress").value = cssScores.length;
document.getElementById("js-progress").value = javascriptScores.length;

// Calculating Avg Quiz Scores
let htmlAvg = (htmlScores) => htmlScores.reduce((a, b) => a + b) / htmlScores.length;
if(htmlScores.length === 0) {
    document.getElementById("htmlAvg").innerHTML = 0;
} else { document.getElementById("htmlAvg").innerHTML = htmlAvg(htmlScores).toFixed(2); }

let cssAvg = (cssScores) => cssScores.reduce((a, b) => a + b) / cssScores.length;
if(cssScores.length === 0) {
    document.getElementById("cssAvg").innerHTML = 0;
} else { document.getElementById("cssAvg").innerHTML = cssAvg(cssScores).toFixed(2); }

let jsAvg = (javascriptScores) => javascriptScores.reduce((a, b) => a + b) / javascriptScores.length;
if(javascriptScores.length === 0) {
    document.getElementById("jsAvg").innerHTML = 0;
} else { document.getElementById("jsAvg").innerHTML = jsAvg(javascriptScores).toFixed(2); }

// Displaying Total Completion
document.getElementById("htmlComplete").innerHTML = (htmlScores.length/5)*100;
document.getElementById("cssComplete").innerHTML = (cssScores.length/5)*100;
document.getElementById("jsComplete").innerHTML = (javascriptScores.length/5)*100;



// Javascript to make the side menu do the fancy shit
const accordion = document.getElementsByClassName('has-submenu');

for(let i = 0; i < accordion.length; i++) {
  accordion[i].onclick = function () {
    this.classList.toggle('is-active');
    
    const submenu = this.nextElementSibling;
    
    if(submenu.style.maxHeight){
      //Close menu
      // console.log('tutup');
      submenu.style.maxHeight = null;
      submenu.style.marginTop = null;
      submenu.style.marginBottom = null;
    }else {
      //Open menu
      // console.log('Open');
      submenu.style.maxHeight = submenu.scrollHeight + "px";
      submenu.style.marginTop = "0.2em";
      submenu.style.marginBottm = "0.22em";
    }
  }
}
/** Dashboard Clock */
function showTime() {
    var date = new Date(),
        utc = new Date(Date(
          date.getFullYear(),
          date.getMonth(),
          date.getDate(),
          date.getHours(),
          date.getMinutes(),
          date.getSeconds()
        ));

    document.getElementById('time').innerHTML = utc.toLocaleTimeString();
}

setInterval(showTime, 1000);

/** Side Menu Toggle  */
function dashToggle() {
    const dashTabs = document.querySelectorAll('.menu-list a');
    const dashContents = document.querySelectorAll('.dash-content');

    if(location.hash) {
        const dashTab = document.querySelector(`[href="${location.hash}"]`);
        const dashContent = document.querySelector(location.hash);

        dashTab.classList.add('is-active');
        dashContent.classList.add('display-dash-content');
    } else {
        if (dashTabs[0]) {
        dashTabs[0].classList.add('is-active');
        dashContents[0].classList.add('display-dash-content');
        }
    }

    window.addEventListener('hashchange', () => {
        const tabName = location.hash.split('#')[1];
        const dashTab = document.querySelector(`[href="#${tabName}"]`);
        const dashContent = document.querySelector(`#${tabName}`);

        // loop through all activated tab and hide them
        for (let i = dashContents.length - 1; i >= 0; i--) {
            dashContents[i].classList.remove('display-dash-content');
        }
        for (let i = dashTabs.length - 1; i >= 0; i--) {
            dashTabs[i].classList.remove('is-active');
        }

        // activate the selected tab
        dashTab.classList.add('is-active');
        dashContent.classList.add('display-dash-content');
    });
}

window.onload = dashToggle;

/** Update Profile Button Toggle */
function updateProfileToggle() {
    let cancelBtn = document.getElementById("cancelChange");
    let submitChangesBtn = document.getElementById("saveChangesProfile");
    let updateProfileBtn = document.getElementById("updateProfileBtn");
    let inputField = document.querySelectorAll(".profile-field");

    for (let i = inputField.length - 1; i >= 0; i--) {
        inputField[i].toggleAttribute("disabled");
    }
    updateProfileBtn.classList.toggle("is-hidden");
    cancelBtn.classList.toggle("is-hidden");
    submitChangesBtn.classList.toggle("is-hidden");
}

function updatePhotoToggle() {
    let cancelBtn = document.getElementById("cancelChangePhoto");
    let submitChangesBtn = document.getElementById("saveChangesPhoto");
    let updateProfileBtn = document.getElementById("updatePhotoBtn");
    let photoInput = document.getElementById("inputPhoto")

    updateProfileBtn.classList.toggle("is-hidden");
    cancelBtn.classList.toggle("is-hidden");
    submitChangesBtn.classList.toggle("is-hidden");
    photoInput.classList.toggle("is-hidden");
}
