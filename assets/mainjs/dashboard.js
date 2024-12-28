$(document).ready(function () {
    let currentDate = new Date(); // Current date
    const oneWeek = 7 * 24 * 60 * 60 * 1000; // One week in milliseconds
    let startDate, endDate;

    // Function to format date as 'YYYY-MM-DD'
    function formatDate(date) {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    }

    // Fetch sales data and update chart
    function fetchSalesData(startDate, endDate) {
        $.ajax({
            url: `${base}/dashboard/get_weekly_sales`,
            method: 'GET',
            data: { start_date: startDate, end_date: endDate }, // Pass date range
            success: function (response) {
                const salesData = JSON.parse(response);

                // Prepare data for the chart
                const dates = salesData.map(item => item.date); // x-axis: dates
                const sales = salesData.map(item => item.total_sales); // y-axis: sales values

                // Chart options
                const options = {
                    chart: {
                        type: 'bar',
                        height: 245
                    },
                    series: [{
                        name: 'Total Sales',
                        data: sales
                    }],
                    xaxis: {
                        categories: dates
                    },
                    yaxis: {},
                    colors: ['#3b6bff']
                };

                // Destroy the existing chart if it exists
                if (window.salesChart instanceof ApexCharts) {
                    window.salesChart.destroy(); // Safely destroy the existing chart
                }

                // Initialize and render the chart
                window.salesChart = new ApexCharts(document.querySelector("#salesChart"), options);
                window.salesChart.render();
            },
            error: function (error) {
                console.error('Error fetching sales data:', error);
            }
        });
    }

    // Set initial date range: most recent 7 days
    function resetToRecentWeek() {
        endDate = currentDate; // Today
        startDate = new Date(endDate.getTime() - oneWeek); // 7 days ago
        fetchSalesData(formatDate(startDate), formatDate(endDate));
    }

    // Initial load: most recent week
    resetToRecentWeek();

    // Handle Previous button click
    $('#previousButton').on('click', function () {
        // Move back by one week
        endDate = new Date(startDate.getTime() - 1); // The day before the current start date
        startDate = new Date(endDate.getTime() - oneWeek); // 7 days before the new end date
        fetchSalesData(formatDate(startDate), formatDate(endDate));
    });

    // Handle Next button click
    $('#nextButton').on('click', function () {
        // Move forward by one week
        if (endDate < currentDate) { // Prevent fetching future weeks
            startDate = new Date(endDate.getTime() + 1); // The day after the current end date
            endDate = new Date(startDate.getTime() + oneWeek); // 7 days after the new start date
            fetchSalesData(formatDate(startDate), formatDate(endDate));
        }
    });

    // Handle Most Recent button click
    $('#recentButton').on('click', function () {
        resetToRecentWeek();
    });
});
