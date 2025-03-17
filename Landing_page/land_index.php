<?php
    include 'c:/xampp/htdocs/doc_direct_main/connection.php'; // Include your database connection

    // Fetch categories from the database
    $category_query = "SELECT category_id, category_name FROM category";
    $category_result = mysqli_query($connection, $category_query);

    //fetch Hospitals from the database
    $hos_query = "SELECT hos_id, hos_name FROM hospitals";
    $hos_result = mysqli_query($connection, $hos_query);

    if (!$category_result) {
        die('Query Failed: ' . mysqli_error($connection));
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="land_style.css?v=<?php echo time(); ?>">

    <!-- Flatpickr CSS for calendar and time picker -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-bold-rounded/css/uicons-bold-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-bold-rounded/css/uicons-bold-rounded.css'>

    <!-- Flatpickr JS for functionality -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</head>
<body>

    <nav class="navbar">
        <div class="logo">Doc Direct</div>
        <ul class="nav-links">
            <li><a href="land_index.php">Home</a></li>
            
            <li><a href="appoinment.php">Appoinment</a></li>
            <li><a href="#">About Us</a></li>
            <li><a onclick="openNav()" style="cursor:pointer;"><i class="fi fi-br-search"></i></a></li>
            <li><a href="#"><i class="fi fi-br-insert-alt"></i></a></li>

        </ul>
    </nav>
<!--Search panel-->
<div id="mySidepanel" class="sidepanel">
    <a onclick="closeNav()" class="search-close">X</a>

    <div class="container">
    <h1>Find Medical Resources</h1>
    
    <div class="search-container">
      <!-- Search Input Area -->
      <div class="search-area">
        <div class="search-input-wrapper">
          <i class="fa fa-search search-icon"></i>
          <input type="text" id="searchInput" placeholder="Search for doctors, conditions, treatments...">
          <button id="clearSearch" class="clear-btn hidden">
            <i class="fa fa-times"></i>
          </button>
        </div>
        
        <!-- Filter Button -->
        <button id="filterBtn" class="filter-btn">
          <i class="fa fa-filter"></i>
          <span>Filters</span>
          <span id="filterCount" class="filter-count hidden">0</span>
        </button>
        
        <!-- Search Button -->
        <button id="searchBtn" class="search-btn">
          <i class="fa fa-search"></i>
          <span>Search</span>
        </button>
      </div>
      
      <!-- Filter Dropdown -->
      <div id="filterDropdown" class="filter-dropdown hidden">
        <div class="filter-header">
          <h3>Refine your search</h3>
          <button id="clearAllBtn" class="clear-all-btn hidden">Clear all</button>
        </div>
        
        <!-- Medical Specialties -->
        <div class="filter-section">
          <h4><i class="fa fa-user-md"></i> Medical Specialty</h4>
          <div class="filter-options" data-filter-id="specialty">
            <button class="filter-option" data-option="Cardiology">Cardiology</button>
            <button class="filter-option" data-option="Dermatology">Dermatology</button>
            <button class="filter-option" data-option="Neurology">Neurology</button>
            <button class="filter-option" data-option="Pediatrics">Pediatrics</button>
            <button class="filter-option" data-option="Oncology">Oncology</button>
          </div>
        </div>
        
        <!-- Treatment Types -->
        <div class="filter-section">
          <h4><i class="fa fa-stethoscope"></i> Treatment Type</h4>
          <div class="filter-options" data-filter-id="treatment">
            <button class="filter-option" data-option="Surgery">Surgery</button>
            <button class="filter-option" data-option="Medication">Medication</button>
            <button class="filter-option" data-option="Therapy">Therapy</button>
            <button class="filter-option" data-option="Preventive Care">Preventive Care</button>
          </div>
        </div>
        
        <!-- Insurance -->
        <div class="filter-section">
          <h4><i class="fa fa-id-card"></i> Insurance</h4>
          <div class="filter-options" data-filter-id="insurance">
            <button class="filter-option" data-option="Medicare">Medicare</button>
            <button class="filter-option" data-option="Medicaid">Medicaid</button>
            <button class="filter-option" data-option="Private">Private Insurance</button>
            <button class="filter-option" data-option="Self-Pay">Self-Pay</button>
          </div>
        </div>
      </div>
      
      <!-- Active Filters Display -->
      <div id="activeFilters" class="active-filters hidden"></div>
    </div>
    
    <div class="results-container">
      <h2>Search Results</h2>
      <p class="results-message">Enter search terms and select filters to find medical resources.</p>
    </div>
  </div>

</div>

    <!-- Slideshow container -->
    <div class="slideshow-container">
        <div class="mySlides fade">
            <div class="numbertext">1 / 3</div>
            <img src="img1.jpg" style="width:100%">
            <div class="text">Caption Text</div>
        </div>

        <div class="mySlides fade">
            <div class="numbertext">2 / 3</div>
            <img src="img2.jpg" style="width:100%">
            <div class="text">Caption Two</div>
        </div>

        <div class="mySlides fade">
            <div class="numbertext">3 / 3</div>
            <img src="img3.jpg" style="width:100%">
            <div class="text">Caption Three</div>
        </div>

        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>
    <br>

    <div style="text-align:center">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
    </div>

    <section class="opp">
        <div class="opportunities-container">
            <h2>Welcome to Doc Direct</h2><br>
            <p>
                Our online appointment system simplifies the process of booking medical consultations, 
                ensuring convenience for both patients and doctors. This platform enhances accessibility, 
                reduces wait times, and provides seamless scheduling, making healthcare more efficient.
            </p><br>
            <h3>Opportunities of Doc Direct</h3><br>
        </div>
    </section>
    
    <section class="listview">
        <div class="list">
            <h1>hi</h1>
        </div>
    </section>

    <section class="appo" id="appo">
        <div class="container">
            <form class="horizontal-form">
                <div class="form-group" id="doctor-name">
                    <label for="doctor-name">Doctor Name</label>
                    <input type="text" id="doctor-name" placeholder="Search Doctor Name">
                </div>

                <div class="form-group">
                    <label for="specialization">Specialization</label>
                    <select id="specialization" name="specialization">
                        <option value="">Select Specialization</option>
                        <?php
                            while ($row = mysqli_fetch_assoc($category_result)) {
                                echo "<option value='" . $row['category_id'] . "'>" . $row['category_name'] . "</option>";
                            }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="hospital">Hospital</label>
                    <select id="hospital">
                        <option value="">Select Hospital</option>
                        <?php
                            while ($row = mysqli_fetch_assoc($hos_result)) {
                                echo "<option value='" . $row['hos_id'] . "'>" . $row['hos_name'] . "</option>";
                            }
                        ?>
                    </select>
                </div>

                <!-- Calendar Input for Date -->
                <div class="form-group" id="date">
                    <label for="date">Date</label>
                    <input type="text" id="date" placeholder="Select Date">
                </div>
                
                <!-- Time Input for Time -->
                <div class="form-group" id="time">
                    <label for="time">Time</label>
                    <input type="text" id="time" placeholder="Select Time">
                </div>

                <button type="submit">Submit</button>
            </form>
        </div>
    </section>

    <section class="home-content">
        <div class="section">
            <h2>Our Vision</h2>
            <p>To revolutionize healthcare accessibility by connecting patients with top doctors and hospitals through a seamless online platform.</p>
        </div>

        <div class="section">
            <h2>Our Mission</h2>
            <p>We aim to provide a user-friendly system that simplifies doctor appointments, enhances patient care, and ensures efficient communication between users and healthcare professionals.</p>
        </div>
    </section>

    <section class="part">
        <div class="section_part">
            <h2>Be a Part of Us</h2>
            <p>Join our platform to experience effortless appointment booking and top-quality healthcare services at your fingertips.</p>
            <button onclick="document.location = 'land_log_index.html'" class="btn">Join Now</button>
        </div>
    </section>

    <script src="land_scripts.js"></script>

    <script>
        // Initialize Flatpickr for date (calendar)
        flatpickr("#date", {
            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
            minDate: "today" // Prevent selecting past dates
        });

        // Initialize Flatpickr for time (time picker)
        flatpickr("#time", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true // Use 24-hour format
        });

        function openNav() {
  document.getElementById("mySidepanel").style.width = "100vw";
}
function closeNav() {
  document.getElementById("mySidepanel").style.width = "0";
}
// Wait for DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
  // DOM Elements
  const searchInput = document.getElementById('searchInput');
  const clearSearchBtn = document.getElementById('clearSearch');
  const filterBtn = document.getElementById('filterBtn');
  const filterDropdown = document.getElementById('filterDropdown');
  const filterCount = document.getElementById('filterCount');
  const clearAllBtn = document.getElementById('clearAllBtn');
  const searchBtn = document.getElementById('searchBtn');
  const activeFiltersContainer = document.getElementById('activeFilters');
  const filterOptions = document.querySelectorAll('.filter-option');
  
  // State
  let isFilterOpen = false;
  let activeFilters = [];
  
  // ===== Event Listeners =====
  
  // Search input events
  searchInput.addEventListener('input', function() {
    // Show/hide clear button based on input content
    if (searchInput.value) {
      clearSearchBtn.classList.remove('hidden');
    } else {
      clearSearchBtn.classList.add('hidden');
    }
  });
  
  // Clear search button
  clearSearchBtn.addEventListener('click', function() {
    searchInput.value = '';
    clearSearchBtn.classList.add('hidden');
    searchInput.focus();
  });
  
  // Filter button toggle
  filterBtn.addEventListener('click', function() {
    isFilterOpen = !isFilterOpen;
    
    if (isFilterOpen) {
      filterDropdown.classList.remove('hidden');
    } else {
      filterDropdown.classList.add('hidden');
    }
  });
  
  // Close filter dropdown when clicking outside
  document.addEventListener('click', function(event) {
    const isClickInside = filterBtn.contains(event.target) || 
                          filterDropdown.contains(event.target);
    
    if (!isClickInside && isFilterOpen) {
      isFilterOpen = false;
      filterDropdown.classList.add('hidden');
    }
  });
  
  // Prevent dropdown from closing when clicking inside it
  filterDropdown.addEventListener('click', function(event) {
    event.stopPropagation();
  });
  
  // Filter button also needs to stop propagation
  filterBtn.addEventListener('click', function(event) {
    event.stopPropagation();
  });
  
  // Add click event to all filter options
  filterOptions.forEach(option => {
    option.addEventListener('click', function() {
      const filterId = this.parentElement.getAttribute('data-filter-id');
      const optionValue = this.getAttribute('data-option');
      
      // Toggle selection
      this.classList.toggle('selected');
      
      // Update active filters
      updateActiveFilters();
    });
  });
  
  // Clear all filters
  clearAllBtn.addEventListener('click', function() {
    // Remove selected class from all options
    filterOptions.forEach(option => {
      option.classList.remove('selected');
    });
    
    // Clear active filters
    activeFilters = [];
    updateFilterUI();
  });
  
  // Search button
  searchBtn.addEventListener('click', function() {
    performSearch();
  });
  
  // Allow search on Enter key
  searchInput.addEventListener('keypress', function(event) {
    if (event.key === 'Enter') {
      performSearch();
    }
  });
  
  // ===== Functions =====
  
  // Update active filters based on selected options
  function updateActiveFilters() {
    // Clear current active filters
    activeFilters = [];
    
    // Get all selected options
    document.querySelectorAll('.filter-option.selected').forEach(option => {
      const filterId = option.parentElement.getAttribute('data-filter-id');
      const optionValue = option.getAttribute('data-option');
      
      activeFilters.push({
        id: filterId,
        value: optionValue
      });
    });
    
    // Update UI
    updateFilterUI();
  }
  
  // Update filter UI elements
  function updateFilterUI() {
    // Update filter count
    if (activeFilters.length > 0) {
      filterCount.textContent = activeFilters.length;
      filterCount.classList.remove('hidden');
      filterBtn.classList.add('active');
      clearAllBtn.classList.remove('hidden');
    } else {
      filterCount.classList.add('hidden');
      filterBtn.classList.remove('active');
      clearAllBtn.classList.add('hidden');
    }
    
    // Update active filters display
    renderActiveFilters();
  }
  
  // Render active filter tags
  function renderActiveFilters() {
    // Clear container
    activeFiltersContainer.innerHTML = '';
    
    if (activeFilters.length === 0) {
      activeFiltersContainer.classList.add('hidden');
      return;
    }
    
    // Show container
    activeFiltersContainer.classList.remove('hidden');
    
    // Group filters by type
    const filterGroups = {};
    activeFilters.forEach(filter => {
      if (!filterGroups[filter.id]) {
        filterGroups[filter.id] = [];
      }
      filterGroups[filter.id].push(filter.value);
    });
    
    // Create filter tags
    for (const [filterId, values] of Object.entries(filterGroups)) {
      values.forEach(value => {
        // Create filter tag
        const tag = document.createElement('div');
        tag.className = 'filter-tag';
        
        // Get filter name
        let filterName = '';
        switch(filterId) {
          case 'specialty':
            filterName = 'Specialty';
            break;
          case 'treatment':
            filterName = 'Treatment';
            break;
          case 'insurance':
            filterName = 'Insurance';
            break;
          default:
            filterName = filterId.charAt(0).toUpperCase() + filterId.slice(1);
        }
        
        // Set tag content
        tag.innerHTML = `
          <span>${filterName}: ${value}</span>
          <button class="remove-tag" data-filter-id="${filterId}" data-option="${value}">
            <i class="fa fa-times"></i>
          </button>
        `;
        
        // Add to container
        activeFiltersContainer.appendChild(tag);
      });
    }
    
    // Add clear all button
    if (activeFilters.length > 0) {
      const clearTag = document.createElement('button');
      clearTag.className = 'clear-tag';
      clearTag.innerHTML = '<i class="fa fa-times"></i> Clear all';
      clearTag.addEventListener('click', function() {
        // Clear all filters
        filterOptions.forEach(option => {
          option.classList.remove('selected');
        });
        activeFilters = [];
        updateFilterUI();
      });
      
      activeFiltersContainer.appendChild(clearTag);
    }
    
    // Add event listeners to remove buttons
    document.querySelectorAll('.remove-tag').forEach(button => {
      button.addEventListener('click', function() {
        const filterId = this.getAttribute('data-filter-id');
        const optionValue = this.getAttribute('data-option');
        
        // Find and deselect the corresponding option
        const option = document.querySelector(`.filter-options[data-filter-id="${filterId}"] .filter-option[data-option="${optionValue}"]`);
        if (option) {
          option.classList.remove('selected');
        }
        
        // Update active filters
        updateActiveFilters();
      });
    });
  }
  
  // Perform search
  function performSearch() {
    const searchTerm = searchInput.value.trim();
    
    // Get selected filters for display
    const selectedFilters = {};
    activeFilters.forEach(filter => {
      if (!selectedFilters[filter.id]) {
        selectedFilters[filter.id] = [];
      }
      selectedFilters[filter.id].push(filter.value);
    });
    
    // Log search parameters (replace with actual search implementation)
    console.log('Search Term:', searchTerm);
    console.log('Filters:', selectedFilters);
    
    // Update results message
    const resultsMessage = document.querySelector('.results-message');
    
    if (searchTerm || activeFilters.length > 0) {
      // In a real application, you would fetch results here
      resultsMessage.textContent = `Searching for "${searchTerm}" with ${activeFilters.length} filters...`;
      
      // Simulate search results (remove in real implementation)
      setTimeout(() => {
        resultsMessage.textContent = `Found 5 results for "${searchTerm || 'all items'}"`;
      }, 1000);
    } else {
      resultsMessage.textContent = 'Please enter search terms or select filters to find medical resources.';
    }
  }
});
    </script>

</body>
</html>

<?php mysqli_close($connection); ?>
