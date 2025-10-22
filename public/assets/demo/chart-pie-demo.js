// Set new default font family and font color to mimic Bootstrap's default styling
(Chart.defaults.global.defaultFontFamily = "Metropolis"),
    '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = "#858796";

// Pie Chart Example
document.addEventListener("DOMContentLoaded", function () {
    var ctx = document.getElementById("myPieChart");
    if (!ctx) return; // Stop kalau canvas belum ada

    new Chart(ctx, {
        type: "doughnut",
        data: {
            labels: ["Direct", "Referral", "Social"],
            datasets: [{
                data: [55, 30, 15],
                backgroundColor: [
                    "rgba(0, 97, 242, 1)",
                    "rgba(0, 172, 105, 1)",
                    "rgba(88, 0, 232, 1)"
                ],
                hoverBackgroundColor: [
                    "rgba(0, 97, 242, 0.9)",
                    "rgba(0, 172, 105, 0.9)",
                    "rgba(88, 0, 232, 0.9)"
                ],
                hoverBorderColor: "rgba(234, 236, 244, 1)"
            }]
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyColor: "#858796",
                    borderColor: "#dddfeb",
                    borderWidth: 1,
                    padding: 15,
                    displayColors: false,
                    callbacks: {
                        label: function (context) {
                            return `${context.label}: ${context.formattedValue}%`;
                        }
                    }
                }
            },
            cutout: "80%" // pengganti cutoutPercentage
        }
    });
});
