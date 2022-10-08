"use strict";
$(document).ready(function () {
 //Nice Select
 $(".niceSelect").niceSelect();

    //Circle Chart
    $("#outerCircleChart").easyPieChart({
      barColor: " #F2994A",
      trackColor: "#3C3C3C",
      scaleLength: 0,
      lineWidth: 15,
      lineCap: "circle",
      size: 210,
    });
    $("#innerCircleChart").easyPieChart({
      barColor: "#A22177",
      trackColor: "#3C3C3C",
      scaleLength: 0,
      lineWidth: 10,
      lineCap: "circle",
      size: 160,
    });


});


//Order Dropdown
let orderMoreButton = document.querySelectorAll("#orderMoreButton");
for (let x of orderMoreButton) {
  x.addEventListener("click", (e) => {
    let orderDiv = e.target.parentElement.parentElement;
    orderDiv.classList.toggle("order_dropdwon_active");
    let overlayDropdown = e.target.parentElement.parentElement.children[2];

    if (overlayDropdown) {
      overlayDropdown.addEventListener("click", () => {
        orderDiv.classList.remove("order_dropdwon_active");
      });
    }
  });
}

//Counter
let visibilityIds = [
    "#counters_1",
    "#counters_2",
    "#counters_3",
    "#counters_4",
  ];
  // default counter class
  let counterClass = ".counter";
  // default animation speed
  let defaultSpeed = 3000;


  //chart

//Weak Chart
const labelsLineWeek = ["Sat", "Sun", "Mon", "Tue", "Wed", "Thu", "Fri"];

const dataLineWeek = {
  labels: labelsLineWeek,
  datasets: [
    {
      label: "Week Value 1",
      backgroundColor: "#2DB75B",
      borderColor: "#2DB75B",
      data: [5000, 7000, 3000, 6000, 2000, 8000, 15000],
      tension: 0.4,
    },
    {
      label: "Week Value 2",
      backgroundColor: " #FF965D",
      borderColor: " #FF965D",
      data: [4000, 6500, 5000, 7000, 5000, 9000, 12000],
      tension: 0.4,
    },
  ],
};

const configLineWeek = {
  type: "line",
  data: dataLineWeek,

  options: {
    responsive: true,
    plugins: {
      title: {
        display: true,
      },
    },
    interaction: {
      intersect: false,
    },
    scales: {
      x: {
        display: true,

        title: {
          display: true,
        },
        grid: {
          display: false,
        },
      },
      y: {
        display: true,
        grid: {
          color: " #27123E",
        },
        ticks: {
          callback: function (value, index, values) {
            return "$" + value;
          },
        },
      },
    },
  },
};

const chartWeek = new Chart(
  document.getElementById("chartWeek"),
  configLineWeek
);