@extends('layout')
@section('title', 'Exam Details | Dashboard')
@section('content')
    {{-- --}}
    
        <form id="examForm" action="{{ route('user.exam.check',$data->id) }}" method="post">
            @csrf
            <h1>{{ $data->title }} <p id="timer" class="d-inline float-right"></p></h1>
            @foreach ($questions as $key => $question)
          <!-- One "tab" for each step in the form: -->
          <div class="tab bg-secondary text-white p-1">{{ $question->title }}:
            <p><input type="radio" name="{{ 'answer'.$key }}" value="opt1" class="px-1 mx-1" > {{ $question->opt1 }}</p>
            <p><input type="radio" name="{{ 'answer'.$key }}" value="opt2" class="px-1 mx-1" > {{ $question->opt2 }}</p>
            <p><input type="radio" name="{{ 'answer'.$key }}" value="opt3" class="px-1 mx-1" > {{ $question->opt3 }}</p>
            <p><input type="radio" name="{{ 'answer'.$key }}" value="opt4" class="px-1 mx-1" > {{ $question->opt4 }}</p>
            <input type="hidden" name="{{ 'q'.$key }}" value="{{ $question->id }}" >
          </div>
         @endforeach
          <div style="overflow:auto;">
            <div style="float:right;">
              <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
              <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
            </div>
          </div>
          <!-- Circles which indicates the steps of the form: -->
          <div style="text-align:center;margin-top:40px;">
            @foreach ($questions as $key => $question)
            <span class="step"></span>
            @endforeach
          </div>
          <input type="submit" style="display: none;" id="submitBtn">
        </form>
<script>
    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab
    
    function showTab(n) {
        // This function will display the specified tab of the form...
        var x = document.getElementsByClassName("tab");
        x[n].style.display = "block";
        //... and fix the Previous/Next buttons:
        if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
        } else {
        document.getElementById("prevBtn").style.display = "inline";
        }
        if (n == (x.length - 1)) {
        document.getElementById("nextBtn").innerHTML = "Submit";
        } else {
        document.getElementById("nextBtn").innerHTML = "Next";
        }
        //... and run a function that will display the correct step indicator:
        fixStepIndicator(n)
    }
    
    function nextPrev(n) {
        // This function will figure out which tab to display
        var x = document.getElementsByClassName("tab");
        // Exit the function if any field in the current tab is invalid:
        if (n == 1 && !validateForm()) return false;
        // Hide the current tab:
        x[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        currentTab = currentTab + n;
        // if you have reached the end of the form...
        if (currentTab >= x.length) {
        // ... the form gets submitted:
        document.getElementById("examForm").submit();
        return false;
        }
        // Otherwise, display the correct tab:
        showTab(currentTab);
    }
    
    function validateForm() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        x = document.getElementsByClassName("tab");
        y = x[currentTab].getElementsByTagName("input");
        // A loop that checks every input field in the current tab:
        for (i = 0; i < y.length; i++) {
        // If a field is empty...
        if (y[i].value == "") {
            // add an "invalid" class to the field:
            y[i].className += " invalid";
            // and set the current valid status to false
            valid = false;
        }
        }
        // If the valid status is true, mark the step as finished and valid:
        if (valid) {
        document.getElementsByClassName("step")[currentTab].className += " finish";
        }
        return valid; // return the valid status
    }
    
    function fixStepIndicator(n) {
        // This function removes the "active" class of all steps...
        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
        }
        //... and adds the "active" class on the current step:
        x[n].className += " active";
    }
    </script>
          
<script>
    let timeInSeconds = {{ $data->time }}* 60; // Set the initial time in seconds
    const form = document.getElementById('examForm');
    const submitBtn = document.getElementById('submitBtn');

    function updateTimer() {
        const minutes = Math.floor(timeInSeconds / 60);
        const seconds = timeInSeconds % 60;
        const formattedTime = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
        document.getElementById('timer').textContent = formattedTime;
    }

    function decrementTimer() {
        if (timeInSeconds > 0) {
        timeInSeconds--;
        updateTimer();
        setTimeout(decrementTimer, 1000);
        } else {
        // Timer reached 0, trigger form submission
        submitBtn.click();
        }
    }

    // Initial call to start the timer
    decrementTimer();
</script>
        
        <style>
            
            #examForm {
              background-color: #ffffff;
              margin: 100px auto;
              font-family: Raleway;
              padding: 40px;
              width: 70%;
              min-width: 300px;
            }
            /* Mark input boxes that gets an error on validation: */
            input.invalid {
              background-color: #ffdddd;
            }
            
            /* Hide all steps by default: */
            .tab {
              display: none;
            }
            button {
              background-color: #04AA6D;
              color: #ffffff;
              border: none;
              padding: 10px 20px;
              font-size: 17px;
              font-family: Raleway;
              cursor: pointer;
            }
            
            button:hover {
              opacity: 0.8;
            }
            
            #prevBtn {
              background-color: #bbbbbb;
            }
            
            /* Make circles that indicate the steps of the form: */
            .step {
              height: 15px;
              width: 15px;
              margin: 0 2px;
              background-color: #bbbbbb;
              border: none;  
              border-radius: 50%;
              display: inline-block;
              opacity: 0.5;
            }
            
            .step.active {
              opacity: 1;
            }
            
            /* Mark the steps that are finished and valid: */
            .step.finish {
              background-color: #04AA6D;
            }
            </style> 
{{--  --}}
    @section('scripts')
    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    @endsection
@endsection

