function fillFormWithData() {
    let eventData = {
        event_name: "Sample Event",
        event_attendees: "email1@example.com, email2@example.com",
        event_date: "2023-10-05 15:30:00"
    };

    document.getElementById("event-title").value = eventData.event_name;
    document.getElementById("event-attendees").value = eventData.event_attendees;
    document.getElementById("event-date").value = eventData.event_date;
}


document.getElementById("btn-fill-form-test-data").addEventListener("click", function (e) {
    e.preventDefault();
    fillFormWithData();
});