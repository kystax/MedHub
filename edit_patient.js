function fetchPatientData() {
    const patientId = document.getElementById('patient-id-input').value;
    
    fetch(`fetch.php?id=${patientId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('patient-id').value = patientId;
                document.getElementById('name').value = data.name;
                document.getElementById('dob').value = data.dob;
                document.getElementById('address').value = data.address;
                document.getElementById('gender').value = data.gender;
                document.getElementById('contact').value = data.contact;
                document.getElementById('guardian').value = data.guardian;
                document.getElementById('admission_date').value = data.admission_date;
                document.getElementById('doctor').value = data.doctor;
                document.getElementById('notes').value = data.notes;
                 
            } else {
                alert('Patient not found');
            }
        })
        .catch(error => console.error('Error fetching patient data:', error));
}
