//lessonsCompleted Chart
// var lessonsCompleted = document.getElementById('lessonsCompleted').getContext('2d');
// var myChart = new Chart(lessonsCompleted, {
//     type: 'bar',
//     data: {
//         labels: ['HTML', 'CSS', 'JavaScript'],
//         datasets: [{
//             label: '# Completed',
//             data: [10, 3, 6],
//             backgroundColor: [
//                 'rgba(75, 192, 192, 0.2)',
//                 'rgba(255, 159, 64, 0.2)',
//                 'rgba(54, 162, 235, 0.2)',
//                 //'rgba(255, 99, 132, 0.2)',
//                 //'rgba(255, 206, 86, 0.2)',
//                 //'rgba(153, 102, 255, 0.2)',
//             ],
//             borderColor: [
//                 'rgba(75, 192, 192, 1)',
//                 'rgba(255, 159, 64, 1)',
//                 'rgba(54, 162, 235, 1)',
//                 //'rgba(255, 99, 132, 1)',
//                 //'rgba(255, 206, 86, 1)',
//                 //'rgba(153, 102, 255, 1)',
//             ],
//             borderWidth: 1
//         }]
//     },
//     options: {
//         scales: {
//             yAxes: [{
//                 ticks: {
//                     beginAtZero: true
//                 }
//             }]
//         }
//     }
// });
//Quiz Scores Chart
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
