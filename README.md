# Brake-RoomApp brake-room.ch
A web App that tracks what rooms are currently unoccupied at my school and displays it

This is just a small Project to track in which rooms at my school are currently unocupied.
I made this webapp since students at my school often search for a empty room to study in silence during brakes. But it often took way too much time to actually find a unocupied room since there is school in most rooms at most times.

In addition the website has a small chat field where anyone can chat with anyone else
I only added this feature since I wanted to make a chat app for a longer time and found this to be the perfect excuse to do exactly that.

<h2>Free Room Tracking:</h2>
I am using a PHP code to request the lecon plan for the week. This script runs once per hour to always have the most accurate information. This script also Filters out all unnecessary and private information from the received POST data then compares all the ocupied rooms during each lecon with a full plan of every room that is currently occupied and POPs the ocupied room out of the ARRAY. At the end it writes a list of all unocupied rooms to a txt file.

For a user to acces the information they request the data with a FETCH request to a php file that is soely made for getting the data from the txt file and relaying it back to the user.

The user then uses the received Data to display all currently unocupied rooms at the School.
