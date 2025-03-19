  // Sample data
  let doctors = [
    {
        id: '1',
        name: 'Dr. John Smith',
        specialization: 'Cardiologist',
        location: 'New York',
        experience: 15
    },
    {
        id: '2',
        name: 'Dr. Sarah Johnson',
        specialization: 'Pediatrician',
        location: 'Los Angeles',
        experience: 10
    }
];

let hospitals = [
    {
        id: '1',
        name: 'Central Hospital',
        location: 'New York',
        type: 'General',
        facilities: ['Emergency', 'Surgery', 'ICU']
    },
    {
        id: '2',
        name: 'Children\'s Medical Center',
        location: 'Los Angeles',
        type: 'Pediatric',
        facilities: ['Pediatric Emergency', 'NICU']
    }
];

let patients = [
    {
        id: '1',
        name: 'Alice Brown',
        age: 35,
        contact: '123-456-7890',
        medicalHistory: ['Hypertension', 'Diabetes']
    },
    {
        id: '2',
        name: 'Bob Wilson',
        age: 45,
        contact: '098-765-4321',
        medicalHistory: ['Asthma']
    }
];

// Navigation
document.querySelectorAll('.nav-item').forEach(item => {
    item.addEventListener('click', () => {
        document.querySelectorAll('.nav-item').forEach(nav => nav.classList.remove('active'));
        item.classList.add('active');

        document.querySelectorAll('.section').forEach(section => section.classList.remove('active'));
        document.getElementById(item.dataset.section).classList.add('active');
    });
});

// Location Filters
document.getElementById('doctorLocationFilter').addEventListener('change', (e) => {
    renderDoctors(e.target.value);
});

document.getElementById('hospitalLocationFilter').addEventListener('change', (e) => {
    renderHospitals(e.target.value);
});

// Delete Functions
function deleteDoctor(id) {
    if (confirm('Are you sure you want to remove this doctor?')) {
        doctors = doctors.filter(d => d.id !== id);
        renderDoctors(document.getElementById('doctorLocationFilter').value);
    }
}

function deleteHospital(id) {
    if (confirm('Are you sure you want to remove this hospital?')) {
        hospitals = hospitals.filter(h => h.id !== id);
        renderHospitals(document.getElementById('hospitalLocationFilter').value);
    }
}

function deletePatient(id) {
    if (confirm('Are you sure you want to remove this patient?')) {
        patients = patients.filter(p => p.id !== id);
        renderPatients();
    }
}

// Render Functions
function renderDoctors(locationFilter = '') {
    const list = document.getElementById('doctorsList');
    const filteredDoctors = locationFilter 
        ? doctors.filter(d => d.location === locationFilter)
        : doctors;

    if (filteredDoctors.length === 0) {
        list.innerHTML = `
            <div class="empty-state">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M16 16s-1.5-2-4-2-4 2-4 2"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/></svg>
                <p>No doctors found</p>
                <span>Try changing the location filter</span>
            </div>
        `;
        return;
    }

    list.innerHTML = filteredDoctors.map(doctor => `
        <div class="list-item">
            <div class="list-item-header">
                <h3 class="list-item-title">${doctor.name}</h3>
                <div class="list-item-actions">
                    <button class="delete-btn" onclick="deleteDoctor('${doctor.id}')">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                        Remove
                    </button>
                </div>
            </div>
            <p>Specialization: ${doctor.specialization}</p>
            <p>Location: ${doctor.location}</p>
            <p>Experience: ${doctor.experience} years</p>
        </div>
    `).join('');
}

function renderHospitals(locationFilter = '') {
    const list = document.getElementById('hospitalsList');
    const filteredHospitals = locationFilter 
        ? hospitals.filter(h => h.location === locationFilter)
        : hospitals;

    if (filteredHospitals.length === 0) {
        list.innerHTML = `
            <div class="empty-state">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M16 16s-1.5-2-4-2-4 2-4 2"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/></svg>
                <p>No hospitals found</p>
                <span>Try changing the location filter</span>
            </div>
        `;
        return;
    }

    list.innerHTML = filteredHospitals.map(hospital => `
        <div class="list-item">
            <div class="list-item-header">
                <h3 class="list-item-title">${hospital.name}</h3>
                <div class="list-item-actions">
                    <button class="delete-btn" onclick="deleteHospital('${hospital.id}')">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                        Remove
                    </button>
                </div>
            </div>
            <p>Location: ${hospital.location}</p>
            <p>Type: ${hospital.type}</p>
            <p>Facilities: ${hospital.facilities.join(', ')}</p>
        </div>
    `).join('');
}

function renderPatients() {
    const list = document.getElementById('patientsList');
    
    if (patients.length === 0) {
        list.innerHTML = `
            <div class="empty-state">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M16 16s-1.5-2-4-2-4 2-4 2"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/></svg>
                <p>No patients found</p>
            </div>
        `;
        return;
    }

    list.innerHTML = patients.map(patient => `
        <div class="list-item">
            <div class="list-item-header">
                <h3 class="list-item-title">${patient.name}</h3>
                <div class="list-item-actions">
                    <button class="delete-btn" onclick="deletePatient('${patient.id}')">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                        Remove
                    </button>
                </div>
            </div>
            <p>Age: ${patient.age}</p>
            <p>Contact: ${patient.contact}</p>
            <p>Medical History:</p>
            <ul>
                ${patient.medicalHistory.map(item => `<li>${item}</li>`).join('')}
            </ul>
        </div>
    `).join('');
}

// Initial Render
renderDoctors();
renderHospitals();
renderPatients();