document.addEventListener("DOMContentLoaded", function() {
    fetch('log_ip.php')
    .then(response => response.text())
    .then(data => console.log(data))
    .catch(error => console.error('Error logging IP:', error));
    

    // Fetch data from the PHP script when the DOM content is loaded
    fetch('sendRoomData.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(dataa => {
            jsonData = dataa["data"];

            // Parse the JSON-like string into an object
            const data = JSON.parse(jsonData);

            // Get the current date and time
            const now = new Date();

            // Initialize a variable to hold the closest date and its data
            let closestDate = null;
            let closestData = {};

            // Convert the object keys to an array and sort them to ensure they are in chronological order
            const sortedDates = Object.keys(data).sort((a, b) => new Date(a.split(',')[0]) - new Date(b.split(',')[0]));

            // Find the closest date that does not exceed the current date
            for (const date of sortedDates) {
                const datePart = date.split(',')[0]; // Extract the actual date string
                const dateObj = new Date(datePart);

                console.log(dateObj);
                // Check if this date is before or equal to the current date and closer than the last found date
                if(now < dateObj){
                    console.log("smaller found");
                    console.log(dateObj);
                    console.log(data[date]);
                    closestDate = dateObj;
                    closestData  = data[date];
                    break;
                }
            }

            console.log(closestData);
            // Check if a closest date was found and write/log the results
            if (closestDate !== null) {
                console.log(`Data for ${closestDate.toISOString().split('T')[0]} ${closestDate.toTimeString().split(' ')[0]}:`);
                console.log(closestData);

                var div = document.getElementById('roomList');
                const dataArray = Object.values(closestData);

                // Now you can use forEach
                dataArray.forEach(item => {
                    div.innerHTML += '<div class="room-container">' + item + '</div>';
                });
            } else {
                console.log("No matching data found.");
            }
        })
        .catch(error => {
            console.error('There was a problem fetching the data:', error);
        });
});