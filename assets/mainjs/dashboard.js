$(document).ready(function () {
    // Fetch sales data from the server
    $.ajax({
        url: base + '/dashboard/get_weekly_sales', // Adjust this URL to your actual endpoint
        method: 'GET',
        success: function (response) {
            // Parse the JSON response
            const salesData = JSON.parse(response);

            // Prepare data for the chart
            const dates = salesData.map(item => item.date); // x-axis: dates
            const sales = salesData.map(item => item.total_sales); // y-axis: sales values

            // Initialize the chart
            const options = {
                chart: {
                    type: 'bar',
                    height: 245
                },
                series: [{
                    name: 'Total Sales',
                    data: sales // y-axis data
                }],
                xaxis: {
                    categories: dates, // x-axis data
                    title: {
                        // text: 'Dates'
                    }
                },
                yaxis: {
                    title: {
                        // text: 'Amount'
                    }
                },
                colors: ['#3b6bff'], // Set bar color
            };

            // Render the chart
            const chart = new ApexCharts(document.querySelector("#salesChart"), options);
            chart.render();
        },
        error: function (error) {
            console.error('Error fetching sales data:', error);
        }
    });
});
