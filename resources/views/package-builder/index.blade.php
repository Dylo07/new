@extends('layouts.app')

@section('title', 'Create Your Custom Package - Soba Lanka')

@section('content')
<div class="min-h-screen bg-black py-20">
    <div class="container mx-auto px-4">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-5xl font-light text-white mb-4">Create Your Custom Package</h1>
            <p class="text-xl text-gray-300">Design the perfect getaway tailored just for you</p>
        </div>

        <!-- Step 1: Guest Count -->
        <div class="max-w-2xl mx-auto bg-gray-900 rounded-xl p-8 mb-8" id="step1">
            <h2 class="text-2xl text-white mb-6 text-center">How many guests will be joining you?</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-white text-lg mb-2">Adults</label>
                    <input 
                        type="number" 
                        id="adults" 
                        min="1" 
                        max="50" 
                        value="2" 
                        class="w-full p-4 rounded-lg bg-gray-800 text-white border border-gray-700 focus:border-green-500 focus:outline-none text-xl text-center"
                    >
                </div>
                <div>
                    <label class="block text-white text-lg mb-2">Kids (3-11 years)</label>
                    <input 
                        type="number" 
                        id="children" 
                        min="0" 
                        max="20" 
                        value="0" 
                        class="w-full p-4 rounded-lg bg-gray-800 text-white border border-gray-700 focus:border-green-500 focus:outline-none text-xl text-center"
                    >
                </div>
            </div>
            
            <div class="text-center mt-8">
                <button 
                    id="nextToRooms" 
                    class="bg-green-500 text-white px-8 py-4 rounded-lg text-xl hover:bg-green-600 transition-all duration-300"
                >
                    Next: Select Rooms
                </button>
            </div>
        </div>

        <!-- Step 1.5: Room Selection -->
        <div class="max-w-2xl mx-auto bg-gray-900 rounded-xl p-8 mb-8 hidden" id="step1_5">
            <h2 class="text-2xl text-white mb-6 text-center">How many rooms do you need?</h2>
            
            <div class="space-y-6">
                <div>
                    <label class="block text-white text-lg mb-2">Double Rooms (Two person)</label>
                    <input 
                        type="number" 
                        id="doubleRooms" 
                        min="0" 
                        max="20" 
                        value="0" 
                        class="w-full p-4 rounded-lg bg-gray-800 text-white border border-gray-700 focus:border-green-500 focus:outline-none text-xl text-center"
                    >
                </div>
                <div>
                    <label class="block text-white text-lg mb-2">Triple Rooms (Three person)</label>
                    <input 
                        type="number" 
                        id="tripleRooms" 
                        min="0" 
                        max="20" 
                        value="0" 
                        class="w-full p-4 rounded-lg bg-gray-800 text-white border border-gray-700 focus:border-green-500 focus:outline-none text-xl text-center"
                    >
                </div>
                <div>
                    <label class="block text-white text-lg mb-2">Family Cottage (Four to Six person)</label>
                    <input 
                        type="number" 
                        id="familyCottages" 
                        min="0" 
                        max="10" 
                        value="0" 
                        class="w-full p-4 rounded-lg bg-gray-800 text-white border border-gray-700 focus:border-green-500 focus:outline-none text-xl text-center"
                    >
                </div>
            </div>

            <!-- Room Summary -->
            <div class="bg-gray-800 rounded-lg p-4 mt-6" id="roomSummary">
                <h3 class="text-white text-lg mb-2">Room Summary</h3>
                <div id="roomSummaryContent" class="text-gray-300"></div>
                <div id="additionalRoomCharges" class="text-yellow-400 mt-2 hidden"></div>
            </div>
            
            <div class="flex gap-4 mt-8">
                <button 
                    id="backToGuests" 
                    class="bg-gray-600 text-white px-6 py-3 rounded-lg hover:bg-gray-700 transition-all duration-300 flex-1"
                >
                    Back
                </button>
                <button 
                    id="findPackages" 
                    class="bg-green-500 text-white px-8 py-3 rounded-lg hover:bg-green-600 transition-all duration-300 flex-1"
                >
                    Find My Perfect Packages
                </button>
            </div>
        </div>

        <!-- Step 2: Package Selection -->
        <div id="step2" class="hidden">
            <div class="text-center mb-8">
                <h2 class="text-3xl text-white mb-2" id="categoryTitle"></h2>
                <p class="text-gray-300" id="guestSummary"></p>
            </div>

            <!-- Package Types -->
            <div id="packageTypes" class="space-y-8">
                <!-- Day Out Packages -->
                <div class="package-type-section" data-type="day_out">
                    <h3 class="text-2xl text-green-400 mb-6 text-center">Day Out Packages</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6" id="dayOutPackages">
                        <!-- Packages will be loaded here -->
                    </div>
                </div>

                <!-- Half Board Packages -->
                <div class="package-type-section" data-type="half_board">
                    <h3 class="text-2xl text-green-400 mb-6 text-center">Half Board Packages</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6" id="halfBoardPackages">
                        <!-- Packages will be loaded here -->
                    </div>
                </div>

                <!-- Full Board Packages -->
                <div class="package-type-section" data-type="full_board">
                    <h3 class="text-2xl text-green-400 mb-6 text-center">Full Board Packages</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6" id="fullBoardPackages">
                        <!-- Packages will be loaded here -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 3: Package Details & Booking -->
        <div id="step3" class="hidden">
            <div class="max-w-4xl mx-auto bg-gray-900 rounded-xl p-8">
                <h2 class="text-3xl text-white mb-6 text-center">Package Details</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Package Info -->
                    <div>
                        <div id="selectedPackageImages" class="mb-6">
                            <!-- Images will be loaded here -->
                        </div>
                        
                        <h3 class="text-2xl text-green-400 mb-4" id="selectedPackageName"></h3>
                        
                        <div class="mb-6">
                            <h4 class="text-lg text-white mb-2">Description</h4>
                            <div class="text-gray-300" id="selectedPackageDescription"></div>
                        </div>
                        
                        <div class="mb-6">
                            <h4 class="text-lg text-white mb-2">Menu</h4>
                            <div class="text-gray-300" id="selectedPackageMenu"></div>
                        </div>
                    </div>
                    
                    <!-- Price Breakdown -->
                    <div class="bg-gray-800 rounded-lg p-6">
                        <h4 class="text-xl text-white mb-4">Price Breakdown</h4>
                        
                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between text-gray-300" id="adultPriceRow">
                                <span>Adults (<span id="adultCount">0</span> × <span id="adultPrice">Rs 0</span>)</span>
                                <span id="adultSubtotal">Rs 0</span>
                            </div>
                            <div class="flex justify-between text-gray-300" id="childPriceRow">
                                <span>Children (<span id="childCount">0</span> × <span id="childPrice">Rs 0</span>)</span>
                                <span id="childSubtotal">Rs 0</span>
                            </div>
                            <div class="flex justify-between text-yellow-300 hidden" id="roomChargesRow">
                                <span>Additional Room Charges</span>
                                <span id="roomCharges">Rs 0</span>
                            </div>
                            <hr class="border-gray-700">
                            <div class="flex justify-between text-xl text-green-400 font-bold">
                                <span>Total</span>
                                <span id="totalPrice">Rs 0</span>
                            </div>
                        </div>
                        
                        <div class="space-y-4">
                            <button 
                                class="w-full bg-green-500 text-white py-3 rounded-lg text-lg hover:bg-green-600 transition-all duration-300"
                                onclick="proceedToBooking()"
                            >
                                Proceed to Booking
                            </button>
                            
                            <button 
                                class="w-full bg-gray-700 text-white py-3 rounded-lg text-lg hover:bg-gray-600 transition-all duration-300"
                                onclick="goBack()"
                            >
                                Choose Different Package
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let selectedPackage = null;
let currentAdults = 2;
let currentChildren = 0;
let currentRooms = {
    double: 0,
    triple: 0,
    family: 0
};
let additionalRoomCharge = 0;

document.addEventListener('DOMContentLoaded', function() {
    // Handle input changes
    document.getElementById('adults').addEventListener('input', updateGuestCount);
    document.getElementById('children').addEventListener('input', updateGuestCount);
    
    // Handle room inputs
    document.getElementById('doubleRooms').addEventListener('input', updateRoomSummary);
    document.getElementById('tripleRooms').addEventListener('input', updateRoomSummary);
    document.getElementById('familyCottages').addEventListener('input', updateRoomSummary);
    
    // Handle navigation buttons
    document.getElementById('nextToRooms').addEventListener('click', proceedToRooms);
    document.getElementById('backToGuests').addEventListener('click', backToGuestSelection);
    document.getElementById('findPackages').addEventListener('click', findPackages);
});

function updateGuestCount() {
    currentAdults = parseInt(document.getElementById('adults').value) || 1;
    currentChildren = parseInt(document.getElementById('children').value) || 0;
}

function proceedToRooms() {
    updateGuestCount();
    
    if (currentAdults < 1) {
        alert('Please enter at least 1 adult.');
        return;
    }
    
    document.getElementById('step1').classList.add('hidden');
    document.getElementById('step1_5').classList.remove('hidden');
    
    // Auto-suggest room configuration
    autoSuggestRooms();
    updateRoomSummary();
}

function backToGuestSelection() {
    document.getElementById('step1_5').classList.add('hidden');
    document.getElementById('step1').classList.remove('hidden');
}

function autoSuggestRooms() {
    const totalGuests = currentAdults + currentChildren;
    
    // Simple auto-suggestion logic
    if (totalGuests <= 2) {
        document.getElementById('doubleRooms').value = 1;
    } else if (totalGuests <= 6) {
        document.getElementById('familyCottages').value = 1;
    } else {
        // For larger groups, suggest a mix
        const familyCottages = Math.floor(totalGuests / 6);
        const remaining = totalGuests % 6;
        
        document.getElementById('familyCottages').value = familyCottages;
        
        if (remaining > 0) {
            if (remaining <= 2) {
                document.getElementById('doubleRooms').value = 1;
            } else if (remaining <= 3) {
                document.getElementById('tripleRooms').value = 1;
            } else {
                document.getElementById('familyCottages').value = familyCottages + 1;
            }
        }
    }
}

function updateRoomSummary() {
    const doubleRooms = parseInt(document.getElementById('doubleRooms').value) || 0;
    const tripleRooms = parseInt(document.getElementById('tripleRooms').value) || 0;
    const familyCottages = parseInt(document.getElementById('familyCottages').value) || 0;
    
    currentRooms = {
        double: doubleRooms,
        triple: tripleRooms,
        family: familyCottages
    };
    
    // Calculate total room capacity
    const totalRoomCapacity = (doubleRooms * 2) + (tripleRooms * 3) + (familyCottages * 6);
    const totalGuests = currentAdults + currentChildren;
    const totalRoomsRequested = doubleRooms + tripleRooms + familyCottages;
    
    // Calculate additional room charges for group packages (>=10 guests)
    additionalRoomCharge = 0;
    let additionalChargeText = '';
    
    if (totalGuests >= 10) {
        const maxFreeRooms = Math.ceil(totalGuests / 3);
        if (totalRoomsRequested > maxFreeRooms) {
            const additionalRooms = totalRoomsRequested - maxFreeRooms;
            additionalRoomCharge = additionalRooms * 4000;
            additionalChargeText = `Additional ${additionalRooms} room(s): Rs ${additionalRoomCharge.toLocaleString()}`;
        }
    }
    
    // Update room summary
    let summaryHTML = '';
    if (doubleRooms > 0) summaryHTML += `${doubleRooms} Double Room(s) (${doubleRooms * 2} capacity)<br>`;
    if (tripleRooms > 0) summaryHTML += `${tripleRooms} Triple Room(s) (${tripleRooms * 3} capacity)<br>`;
    if (familyCottages > 0) summaryHTML += `${familyCottages} Family Cottage(s) (${familyCottages * 6} capacity)<br>`;
    
    summaryHTML += `<div class="mt-2 pt-2 border-t border-gray-600">`;
    summaryHTML += `Total Room Capacity: ${totalRoomCapacity} guests<br>`;
    summaryHTML += `Your Guest Count: ${totalGuests} guests`;
    summaryHTML += `</div>`;
    
    document.getElementById('roomSummaryContent').innerHTML = summaryHTML;
    
    // Show additional charges if applicable
    const additionalChargesDiv = document.getElementById('additionalRoomCharges');
    if (additionalChargeText) {
        additionalChargesDiv.innerHTML = `<strong>Additional Charges:</strong><br>${additionalChargeText}`;
        additionalChargesDiv.classList.remove('hidden');
    } else {
        additionalChargesDiv.classList.add('hidden');
    }
    
    // Validate room capacity
    const findButton = document.getElementById('findPackages');
    if (totalRoomCapacity < totalGuests) {
        findButton.disabled = true;
        findButton.classList.remove('bg-green-500', 'hover:bg-green-600');
        findButton.classList.add('bg-red-500', 'cursor-not-allowed');
        findButton.textContent = 'Insufficient Room Capacity';
    } else {
        findButton.disabled = false;
        findButton.classList.remove('bg-red-500', 'cursor-not-allowed');
        findButton.classList.add('bg-green-500', 'hover:bg-green-600');
        findButton.textContent = 'Find My Perfect Packages';
    }
}

function findPackages() {
    updateGuestCount();
    updateRoomSummary();
    
    if (currentAdults < 1) {
        alert('Please enter at least 1 adult.');
        return;
    }
    
    const totalRoomCapacity = (currentRooms.double * 2) + (currentRooms.triple * 3) + (currentRooms.family * 6);
    const totalGuests = currentAdults + currentChildren;
    
    if (totalRoomCapacity < totalGuests) {
        alert('Room capacity is insufficient for your guest count. Please adjust your room selection.');
        return;
    }
    
    // Show loading state
    const button = document.getElementById('findPackages');
    button.textContent = 'Loading...';
    button.disabled = true;
    
    // Fetch packages
    fetch('/package-builder/get-packages', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            adults: currentAdults,
            children: currentChildren,
            rooms: currentRooms,
            additional_room_charge: additionalRoomCharge
        })
    })
    .then(response => response.json())
    .then(data => {
        displayPackages(data);
        document.getElementById('step1_5').style.display = 'none';
        document.getElementById('step2').classList.remove('hidden');
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error loading packages. Please try again.');
    })
    .finally(() => {
        button.textContent = 'Find My Perfect Packages';
        button.disabled = false;
    });
}

function displayPackages(data) {
    const categoryTitles = {
        'couple': 'Couple Packages',
        'family': 'Family Packages', 
        'group': 'Group Packages'
    };
    
    document.getElementById('categoryTitle').textContent = categoryTitles[data.category];
    document.getElementById('guestSummary').textContent = `${data.adults} Adult${data.adults > 1 ? 's' : ''}${data.children > 0 ? ` and ${data.children} Child${data.children > 1 ? 'ren' : ''}` : ''}`;
    
    // Clear previous packages
    document.getElementById('dayOutPackages').innerHTML = '';
    document.getElementById('halfBoardPackages').innerHTML = '';
    document.getElementById('fullBoardPackages').innerHTML = '';
    
    // Display packages by type
    Object.keys(data.packages).forEach(type => {
        const containerId = type === 'day_out' ? 'dayOutPackages' : 
                           type === 'half_board' ? 'halfBoardPackages' : 
                           'fullBoardPackages';
        
        const container = document.getElementById(containerId);
        
        Object.keys(data.packages[type]).forEach(subType => {
            data.packages[type][subType].forEach(package => {
                const packageCard = createPackageCard(package, data.adults, data.children);
                container.appendChild(packageCard);
            });
        });
        
        // Hide section if no packages
        if (container.children.length === 0) {
            container.parentElement.style.display = 'none';
        }
    });
}

function createPackageCard(package, adults, children) {
    const packageTotal = (package.adult_price * adults) + (package.child_price * children);
    const totalWithRooms = packageTotal + additionalRoomCharge;
    const isAvailable = package.available;
    
    const card = document.createElement('div');
    card.className = `bg-gray-800 rounded-lg p-6 ${isAvailable ? 'hover:bg-gray-700 cursor-pointer' : 'opacity-50'} transition-all duration-300`;
    
    card.innerHTML = `
        <div class="mb-4">
            ${package.images && package.images.length > 0 ? 
                `<img src="/storage/${package.images[0]}" alt="${package.name}" class="w-full h-48 object-cover rounded-lg mb-4">` : 
                '<div class="w-full h-48 bg-gray-700 rounded-lg mb-4 flex items-center justify-center"><span class="text-gray-500">No Image</span></div>'
            }
            <h4 class="text-xl text-white font-bold mb-2">${package.name}</h4>
            ${package.description ? `<p class="text-gray-300 text-sm mb-3">${package.description.substring(0, 100)}...</p>` : ''}
        </div>
        
        <div class="mb-4">
            <div class="text-green-400 text-2xl font-bold">Rs ${totalWithRooms.toLocaleString()}</div>
            <div class="text-gray-400 text-sm">
                Adults: Rs ${package.adult_price} × ${adults} = Rs ${(package.adult_price * adults).toLocaleString()}<br>
                ${children > 0 ? `Children: Rs ${package.child_price} × ${children} = Rs ${(package.child_price * children).toLocaleString()}<br>` : ''}
                ${additionalRoomCharge > 0 ? `Additional Rooms: Rs ${additionalRoomCharge.toLocaleString()}<br>` : ''}
                <strong>Package Total: Rs ${packageTotal.toLocaleString()}</strong>
                ${additionalRoomCharge > 0 ? `<br><strong>Grand Total: Rs ${totalWithRooms.toLocaleString()}</strong>` : ''}
            </div>
        </div>
        
        ${!isAvailable ? 
            '<div class="text-red-400 text-sm mb-2">Requires minimum ' + package.min_adults + ' adults</div>' : 
            ''
        }
        
        <button 
            class="w-full ${isAvailable ? 'bg-green-500 hover:bg-green-600' : 'bg-gray-600'} text-white py-2 rounded-lg transition-all duration-300"
            ${isAvailable ? `onclick="selectPackage(${package.id})"` : 'disabled'}
        >
            ${isAvailable ? 'Select This Package' : 'Not Available'}
        </button>
    `;
    
    return card;
}

function selectPackage(packageId) {
    // Show loading
    const button = event.target;
    button.textContent = 'Loading...';
    button.disabled = true;
    
    fetch('/package-builder/calculate-price', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            package_id: packageId,
            adults: currentAdults,
            children: currentChildren,
            rooms: currentRooms,
            additional_room_charge: additionalRoomCharge
        })
    })
    .then(response => response.json())
    .then(data => {
        selectedPackage = data;
        displayPackageDetails(data);
        document.getElementById('step2').classList.add('hidden');
        document.getElementById('step3').classList.remove('hidden');
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error loading package details. Please try again.');
    })
    .finally(() => {
        button.textContent = 'Select This Package';
        button.disabled = false;
    });
}

function displayPackageDetails(data) {
    document.getElementById('selectedPackageName').textContent = data.package.name;
    document.getElementById('selectedPackageDescription').textContent = data.package.description || 'No description available';
    document.getElementById('selectedPackageMenu').textContent = data.package.menu || 'Menu details not available';
    
    // Display images
    const imagesContainer = document.getElementById('selectedPackageImages');
    imagesContainer.innerHTML = '';
    
    if (data.package.images && data.package.images.length > 0) {
        data.package.images.forEach((image, index) => {
            const img = document.createElement('img');
            img.src = `/storage/${image}`;
            img.alt = data.package.name;
            img.className = 'w-full h-48 object-cover rounded-lg mb-2';
            imagesContainer.appendChild(img);
        });
    } else {
        imagesContainer.innerHTML = '<div class="w-full h-48 bg-gray-700 rounded-lg mb-4 flex items-center justify-center"><span class="text-gray-500">No Images Available</span></div>';
    }
    
    // Update price breakdown
    document.getElementById('adultCount').textContent = data.adults;
    document.getElementById('adultPrice').textContent = `Rs ${data.adult_price.toLocaleString()}`;
    document.getElementById('adultSubtotal').textContent = `Rs ${data.subtotal_adults.toLocaleString()}`;
    
    document.getElementById('childCount').textContent = data.children;
    document.getElementById('childPrice').textContent = `Rs ${data.child_price.toLocaleString()}`;
    document.getElementById('childSubtotal').textContent = `Rs ${data.subtotal_children.toLocaleString()}`;
    
    // Show/hide room charges
    const roomChargesRow = document.getElementById('roomChargesRow');
    if (additionalRoomCharge > 0) {
        document.getElementById('roomCharges').textContent = `Rs ${additionalRoomCharge.toLocaleString()}`;
        roomChargesRow.classList.remove('hidden');
    } else {
        roomChargesRow.classList.add('hidden');
    }
    
    const finalTotal = data.total + additionalRoomCharge;
    document.getElementById('totalPrice').textContent = `Rs ${finalTotal.toLocaleString()}`;
    
    // Hide children row if no children
    document.getElementById('childPriceRow').style.display = data.children > 0 ? 'flex' : 'none';
}

function goBack() {
    document.getElementById('step3').classList.add('hidden');
    document.getElementById('step2').classList.remove('hidden');
}

function proceedToBooking() {
    // Here you can redirect to booking page or open booking form
    // For now, we'll show an alert with all details
    const finalTotal = selectedPackage.total + additionalRoomCharge;
    let bookingDetails = `Package: ${selectedPackage.package.name}\n`;
    bookingDetails += `Adults: ${selectedPackage.adults}, Children: ${selectedPackage.children}\n`;
    bookingDetails += `Rooms: ${currentRooms.double} Double, ${currentRooms.triple} Triple, ${currentRooms.family} Family Cottages\n`;
    if (additionalRoomCharge > 0) {
        bookingDetails += `Additional Room Charges: Rs ${additionalRoomCharge.toLocaleString()}\n`;
    }
    bookingDetails += `Total: Rs ${finalTotal.toLocaleString()}`;
    
    alert('Booking functionality would be implemented here.\n\n' + bookingDetails);
}
</script>

@push('styles')
<style>
body {
    background-color: #000000;
}

.package-type-section:empty {
    display: none;
}
</style>
@endpush
@endsection