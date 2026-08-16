// Bar chart
new Chart(document.getElementById("bar-chart"), {
    type: 'bar',
    data: {
        labels: ["2006", "2010", "2011", "2012", "2018"],
        datasets: [
            {
                label: "Projects",
                backgroundColor: ["#2be4ac", "#2250b0","#2be4ac","#e8c3b9","#2250b0"],
                data: [2478,5267,734,784,433]
            }
        ]
    },
    options: {
        legend: { display: false },
        title: {
            display: true,
            text: 'Projects Yearly Sales'
        }
    }
});

/*pie chart*/

new Chart(document.getElementById("pie-chart"), {
    type: 'pie',
    data: {
        labels: ["Asia", "Europe"],
        datasets: [{
            borderWidth: 0,
            borderColor: "none",
            label: "Population (millions)",
            backgroundColor: [ "#2250b0","#2be4ac"],
            data: [2478,5267]
        }]
    },
    options: {
        title: {
            display: true,
            text: ''
        }
    }
});

/*horixzontal bar chart*/
new Chart(document.getElementById("bar-chart-horizontal"), {
    type: 'horizontalBar',
    data: {
        labels: ["2000", "2010", "2011", "2015", "2020"],
        datasets: [
            {
                label: "Products",
                backgroundColor: ["#2be4ac", "#2250b0","#3cba9f","#e8c3b9","#2250b0"],
                data: [2478,5267,734,784,433]
            }
        ]
    },
    options: {
        legend: { display: false },
        title: {
            display: true,
            text: ''
        }
    }
});

/*grouped bar chart*/
new Chart(document.getElementById("bar-chart-grouped"), {
    type: 'bar',
    data: {
        labels: ["0", "100", "150", "200"],
        datasets: [
            {
                label: "Total Cost",
                backgroundColor: "#2be4ac",
                data: [133,221,783,2478]
            }, {
                label: "Total Revenue",
                backgroundColor: "#2250b0",
                data: [408,547,675,734]
            }
        ]
    },
    options: {
        title: {
            display: true,
            text: ''
        }
    }
});

/*mixed chart*/
new Chart(document.getElementById("mixed-chart"), {
    type: 'bar',
    data: {
        labels: ["Task 1", "Task 2", "Task 3", "Task 4"],
        datasets: [{
                label: "Completed",
                type: "line",
                borderColor: "#2250b0",
                data: [408,547,675,734],
                fill: false
            }, {
                label: "In progress",
                type: "line",
                borderColor: "#2be4ac",
                data: [133,221,783,2478],
                fill: false
            }, {
                label: "completed",
                type: "bar",
                backgroundColor: "rgba(0,0,0,0.2)",
                data: [408,547,675,734],
            }, {
                label: "Started",
                type: "bar",
                backgroundColor: "rgba(0,0,0,0.2)",
                backgroundColorHover: "#2be4ac",
                data: [133,221,783,2478]
            }
        ]
    },
    options: {
        title: {
            display: true,
            text: ''
        },
        legend: { display: false }
    }
});