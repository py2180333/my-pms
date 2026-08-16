// admin
let pie;
let pieInvoice;
let pieActive;
let pieInactive;
$(document).ready(function () {

    function fetchPieChart() {
        const company = $('#company-filter-dashboard').val(); // Get selected company

        const params = new URLSearchParams({
            companyId: company
        });

        fetch(`/admin/dashboard/filter/piechart?${params.toString()}`)
            .then(response => response.json())
            .then(data => {

                $('#allProjects').text(data.count);

                if (pie) {
                    pie.destroy();
                }

                pie = new Chart(document.getElementById("pie-chart"), {
                    type: 'pie',
                    data: {
                        labels: ["Planning", "In Progress", "Completed", "Hold"],
                        datasets: [{
                            borderWidth: 0,
                            borderColor: "none",
                            label: "Population (millions)",
                            backgroundColor: [ "#007bff", "#17a2b8", "#28a745","#dc3545"],
                            data: [data.planning, data.progress, data.completed, data.hold]
                        }]
                    },
                    options: {
                        title: {
                            display: true,
                            text: ''
                        }
                    }
                });
            })
            .catch(error => console.error("Error fetching pie chart:", error));
    }

    function fetchHorizontalBarChart() {

        fetch(`/admin/dashboard/filter/horizontalbarchart`)
            .then(response => response.json())
            .then(data => {

                new Chart(document.getElementById("bar-chart-horizontal"), {
                    type: 'horizontalBar',
                    data: {
                        labels: data.company_name,
                        datasets: [
                            {
                                label: "Products",
                                backgroundColor: ["#2be4ac", "#2250b0","#3cba9f","#e8c3b9","#2250b0"],
                                data: data.projects_count
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
                
            })
            .catch(error => console.error("Error fetching horizontal bar chart:", error));
    }

    // new pr 25-7-25
    function fetchPieChartInvoice() {
        const company = $('#company-filter-dashboard').val(); // Get selected company

        const params = new URLSearchParams({
            companyId: company
        });

        fetch(`/admin/dashboard/filter/piechart/invoice?${params.toString()}`)
            .then(response => response.json())
            .then(data => {

                $('#allInvoices').text(data.count);

                if (pieInvoice) {
                    pieInvoice.destroy();
                }

                pieInvoice = new Chart(document.getElementById("pie-chart-invoice"), {
                    type: 'pie',
                    data: {
                        labels: ["Paid", "Pending", "Overdue"],
                        datasets: [{
                            borderWidth: 0,
                            borderColor: "none",
                            label: "Population (millions)",
                            backgroundColor: [ "#007bff", "#b08b1dff", "#dc3545"],
                            data: [data.paid, data.pending, data.overdue]
                        }]
                    },
                    options: {
                        title: {
                            display: true,
                            text: ''
                        }
                    }
                });
            })
            .catch(error => console.error("Error fetching pie chart invoice:", error));
    }

    // new pr 28-7-25
    function fetchPieChartResource() {
        const labels = [
            "Consultant", "Senior Consultant", "Team Lead", "Senior Team Lead",
            "Project Manager", "Senior Project Manager", "Program Manager", 
            "Senior Program Manager", "Vice President", "Director", "CEO"
        ];

        const backgroundColor = [ 
            "#1f77b4", "#ff7f0e", "#2ca02c", "#d62728",
            "#9467bd", "#8c564b", "#e377c2", "#7f7f7f",
            "#bcbd22", "#17becf", "#000000"
        ];

        const createPieChart = (ctx, chartData) => {
            return new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{
                        borderWidth: 0,
                        borderColor: "none",
                        backgroundColor: backgroundColor,
                        data: chartData
                    }]
                },
                options: {
                    // title: {
                    //     display: true,
                    //     text: ''
                    // },
                    legend: {
                        display: false
                    },
                }
            });
        };

        const company = $('#company-filter-dashboard').val(); // Get selected company

        const params = new URLSearchParams({
            companyId: company
        });

        fetch(`/admin/dashboard/filter/piechart/resource?${params.toString()}`)
            .then(response => response.json())
            .then(data => {

                $('#allresources').text(data.count);
                $('#allActive').text(data.countActive);
                $('#allInactive').text(data.countInactive);

                if (pieActive || pieInactive) {
                    pieActive.destroy();
                    pieInactive.destroy();
                }

                pieActive = createPieChart(document.getElementById("pie-chart-resource-active"), [
                    data.active.consultant, data.active.senior_consultant, data.active.team_lead,
                    data.active.senior_team_lead, data.active.project_manager, data.active.senior_project_manager,
                    data.active.program_manager, data.active.senior_program_manager, data.active.vice_president,
                    data.active.director, data.active.ceo
                ]);

                pieInactive = createPieChart(document.getElementById("pie-chart-resource-inactive"), [
                    data.inactive.consultant, data.inactive.senior_consultant, data.inactive.team_lead,
                    data.inactive.senior_team_lead, data.inactive.project_manager, data.inactive.senior_project_manager,
                    data.inactive.program_manager, data.inactive.senior_program_manager, data.inactive.vice_president,
                    data.inactive.director, data.inactive.ceo
                ]);

            })
            .catch(error => console.error("Error fetching pie chart invoice:", error));
    }

    // Trigger fetch on company filter change
    $('#company-filter-dashboard').change(function () {
        fetchPieChart();
        fetchPieChartInvoice(); // new pr 25-7-25
        fetchPieChartResource(); // new pr 28-7-25
    });

    // Initial fetch
    fetchPieChart();
    fetchHorizontalBarChart();
    fetchPieChartInvoice(); // new pr 25-7-25
    fetchPieChartResource(); // new pr 28-7-25
});
// /admin
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

// new Chart(document.getElementById("pie-chart"), {
//     type: 'pie',
//     data: {
//         labels: ["Asia", "Europe"],
//         datasets: [{
//             borderWidth: 0,
//             borderColor: "none",
//             label: "Population (millions)",
//             backgroundColor: [ "#2250b0","#2be4ac"],
//             data: [2478,5267]
//         }]
//     },
//     options: {
//         title: {
//             display: true,
//             text: ''
//         }
//     }
// });

/*horixzontal bar chart*/
// new Chart(document.getElementById("bar-chart-horizontal"), {
//     type: 'horizontalBar',
//     data: {
//         labels: ["2000", "2010", "2011", "2015", "2020"],
//         datasets: [
//             {
//                 label: "Products",
//                 backgroundColor: ["#2be4ac", "#2250b0","#3cba9f","#e8c3b9","#2250b0"],
//                 data: [2478,5267,734,784,433]
//             }
//         ]
//     },
//     options: {
//         legend: { display: false },
//         title: {
//             display: true,
//             text: ''
//         }
//     }
// });

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