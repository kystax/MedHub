function fetchPatientData() {
    const patientId = document.getElementById('patient-id-input').value.trim();
    if (patientId) {
        fetch(`fetch.php?id=${patientId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    document.getElementById('patient-name').innerText = `Full Name: ${data.name}`;
                    document.getElementById('patient-dob').innerText = `Date of Birth: ${data.dob}`;
                    document.getElementById('patient-address').innerText = `Address: ${data.address}`;
                    document.getElementById('patient-gender').innerText = `Gender: ${data.gender}`;
                    document.getElementById('patient-contact').innerText = `Contact Number: ${data.contact}`;
                    document.getElementById('patient-guardian').innerText = `Guardian Name: ${data.guardian}`;
                    document.getElementById('admission-date').innerText = data.admission_date;
                    document.getElementById('principal-doctor').innerText = data.doctor;
                    document.getElementById('patient-notes').innerText = data.notes;

                     
                    const photoElement = document.getElementById('patient-photo');
                    if (data.photo) {
                        photoElement.src = `${data.photo}`;  
                    } else {
                        photoElement.src = '';  
                    }
                } else {
                    alert('Patient not found');
                }
            })
            .catch(error => {
                console.error('Error fetching patient data:', error);
                alert('An error occurred while fetching patient data.');
            });
    } else {
        alert('Please enter a patient ID');
    }
}
