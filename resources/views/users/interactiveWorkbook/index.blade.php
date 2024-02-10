<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="X-UA-Compatible" content="IE=7">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PEEQ</title>
  <link rel="shortcut icon" href="{{ asset('assets/images/favicon1.ico')}}" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://carstenschaefer.github.io/DrawerJs/dist/drawerJs.css" />
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>
  <main class="main-content" id="main">
    <section class="lm__dash-con lm__event-con lm_pdf">
      <span class="lm_vec">
        <img class="light" src="{{asset('assets/images/light.png')}}" alt="">
        <img class="dark" src="{{asset('assets/images/dark.png')}}" alt=""></span>
      <div class="container mb-5">
        <!-- <div id="canvas-editor"></div> -->
        <div class="row">
          <div class="col-12">
            <div class="pdf-title">
              <h3 class="fw-bold text-primary">Meaning Making & The Impact on Performance</h3>
            </div>
            <!-- Main pdf con -->
            <div class="lm_pdf-card card">
              <span class="lm_spiral">
                <img src="{{asset('assets/images/spiral.png')}}" alt="">
              </span>
              <div class="d-flex card-flex lm__book">
                <div class="lm_pdf-main page">
                </div>
                <div class="lm_pdf-left page">
                  <div class="left-main">
                    <div class="pdf-left-title ">
                      <h3 class="text-primary text-center fw-bold">Meaning Making & The Impact on Performance</h3>
                      <h5 class="text-white text-center fw-bold">Exercise 1</h5>
                      <h3 class="text-primary text-center fw-bold mb-1">
                        Meaning Making</h4>
                    </div>
                    <div class="pdf-left_list">
                      <ul>
                        <li>Meaning Making can both elevate performance and can distract us from performance. </li>
                        <li>Using the Meaning Making diagram on the previous page, over the course of the next week,
                          we'd like you to reflect on your Consumption Audit from the 'How To Get The Most Out Of This
                          Program' workbook.</li>
                        <li> Draw on the insight you've gathered and notice the meaning you make about the world around
                          you and note down how the different elements of the meaning making model impact on your
                          performance both personally and professionally.</li>
                      </ul>
                    </div>
                    <!-- Image -->
                    <div class="pdf-left-img d-flex justify-content-center">
                      <img src="{{asset('assets/images/pdf-01.jpg')}}" alt="">
                    </div>
                    <!-- Additional -->
                    <div class="lm-pdf-addi">
                      <h5 class="text-primary">Additional Resources</h5>
                      <p class="text-white">Complete the workbook below and reflect on your Consumption Audit from the
                        'How To Get The Most Out Of This Program'.</p>
                      <p class="text-white">Note down how the different elements of the Meaning Making Model (images
                        referenced here) impact on your performance both personally and professionally.</p>
                      <div class="pdf-left-img d-flex justify-content-center">
                        <img src="{{asset('assets/images/pdf-02.jpg')}}" alt="">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="lm_pdf-right page" style="background-image:url('assets/images/pdf-right.jpg')">
                  <div class="lm_right">
                    <div class="lm_right-title pb-3">
                      <h3 class="mb-0 text-center">Notes</h3>
                    </div>
                    <img src="{{asset('assets/images/note-border.png')}}" alt="" class="mx-auto">
                  </div>
                  <div class="pdf_con">
                    <div class="pdf-padd">
                      <div class="pdf-date">
                        <span>Today, 21 April 2023</span>
                      </div>
                      <div class="lm__checklist">
                        <div class="heading">
                          <h3 class="fw-bold">Checklist</h3>
                        </div>
                        <div class="lm__list-wrapper">
                          <div class="lm__list-check d-flex gap-3 gap-lg-5">
                            <div class="lm__listtext p-3 mb-3">
                              <p class="mb-0 text-black lh-1">
                                SCHEDULE TIME IN YOUR DIARY TO WORK ON SELF MASTERY
                              </p>
                            </div>
                            <div class="lm__listchecked d-flex align-items-center justify-content-center mb-3">
                                <img src="{{asset('assets/images/check.png')}}" alt="">
                            </div>
                          </div>
                          <div class="lm__list-check d-flex gap-3 gap-lg-5">
                            <div class="lm__listtext p-3 mb-3">
                             <p class="mb-0 text-black lh-1">
                                LM WORKBOOKS/DESIGNATED JOURNAL
                             </p> 
                            </div>
                            <div class="lm__listchecked d-flex align-items-center justify-content-center mb-3">
                                <img src="{{asset('assets/images/check.png')}}" alt="">
                            </div>
                          </div>
                          <div class="lm__list-check d-flex gap-3 gap-lg-5">
                            <div class="lm__listtext p-3 mb-3">
                              <p class="mb-0 text-black lh-1">
                                COACH/SUPPORT SYSTEM
                              </p>
                            </div>
                            <div class="lm__listchecked d-flex align-items-center justify-content-center mb-3">
                                <img src="{{asset('assets/images/check.png')}}" alt="">
                            </div>
                          </div>
                          <div class="lm__list-check d-flex gap-3 gap-lg-5">
                            <div class="lm__listtext p-3 mb-3">
                              <p class="mb-0 text-black lh-1">
                                CONNECT WITH US ON LINKEDIN
                              </p>
                            </div>
                            <div class="lm__listchecked d-flex align-items-center justify-content-center mb-3">
                                <img src="{{asset('assets/images/check.png')}}" alt="">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="lm__consumption">
                        <div class="heading">
                          <h3 class="text-center fw-bold mb-4">Consumption Audit</h3>
                        </div>
                        <div class="lm__consumtion-wrapper d-flex flex-wrap gap-4">
                          <div class="lm__day">
                            <h5 class="text-center">
                              Day One
                            </h5>
                            <div class="lm__consumption-edit">
                              <textarea id="" class="rounded-2"></textarea>
                            </div>
                          </div>
                          <div class="lm__day">
                            <h5 class="text-center">
                              Day Two
                            </h5>
                            <div class="lm__consumption-edit">
                              <textarea id="" class="rounded-2"></textarea>
                            </div>
                          </div>
                          <div class="lm__day">
                            <h5 class="text-center">
                              Day Three
                            </h5>
                            <div class="lm__consumption-edit">
                              <textarea id="" class="rounded-2"></textarea>
                            </div>
                          </div>
                          <div class="lm__day">
                            <h5 class="text-center">
                              Day Four
                            </h5>
                            <div class="lm__consumption-edit">
                              <textarea id="" class="rounded-2"></textarea>
                            </div>
                          </div>
                          <div class="lm__day">
                            <h5 class="text-center">
                              Day Five
                            </h5>
                            <div class="lm__consumption-edit">
                              <textarea id="" class="rounded-2"></textarea>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="lm__task mt-5">
                        <h3>
                          Task 1
                        </h3>
                        <div class="lm__task-editor">
                          <textarea id="" class="rounded-2"></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="lm_pdf-left page">
                  <div class="left-main">
                    <div class="pdf-left-title ">
                      <h3 class="text-primary text-center fw-bold">Meaning Making & The Impact on Performance</h3>
                      <h5 class="text-white text-center fw-bold">Exercise 1</h5>
                      <h3 class="text-primary text-center fw-bold mb-1">
                        Meaning Making</h4>
                    </div>
                    <div class="pdf-left_list">
                      <ul>
                        <li>Meaning Making can both elevate performance and can distract us from performance. </li>
                        <li>Using the Meaning Making diagram on the previous page, over the course of the next week,
                          we'd like you to reflect on your Consumption Audit from the 'How To Get The Most Out Of This
                          Program' workbook.</li>
                        <li> Draw on the insight you've gathered and notice the meaning you make about the world around
                          you and note down how the different elements of the meaning making model impact on your
                          performance both personally and professionally.</li>
                      </ul>
                    </div>
                    <!-- Image -->
                    <div class="pdf-left-img d-flex justify-content-center">
                      <img src="{{asset('assets/images/pdf-01.jpg')}}" alt="">
                    </div>
                    <!-- Additional -->
                    <div class="lm-pdf-addi">
                      <h5 class="text-primary">Additional Resources</h5>
                      <p class="text-white">Complete the workbook below and reflect on your Consumption Audit from the
                        'How To Get The Most Out Of This Program'.</p>
                      <p class="text-white">Note down how the different elements of the Meaning Making Model (images
                        referenced here) impact on your performance both personally and professionally.</p>
                      <div class="pdf-left-img d-flex justify-content-center">
                        <img src="{{asset('assets/images/pdf-02.jpg')}}" alt="">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="lm_pdf-right page" style="background-image:url('assets/images/pdf-right.jpg')">
                  <div class="lm_right">
                    <div class="d-flex justify-content-between">
                      <div class="lm_right-title">
                        <h3 class="mb-0">Notes</h3>
                      </div>
                    </div>
                  </div>
                  <div class="pdf_con">
                    <div class="pdf-padd">
                      <!-- Accordion -->
                      <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                              Interactive
                              <span>
                                <img src="{{asset('assets/images/dlt.svg')}}" alt="">
                              </span>
                            </button>
                          </h2>
                          <div id="collapse1" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body pt-0">
                              <div class="pdf-img trigger" type='button' data-bs-toggle='modal'
                                data-bs-target='#exampleModal-audit'>
                                <img src="{{asset('assets/images/pdf-2.jpg')}}" alt="">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Accordion -->
                      <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                              Interactive
                              <span><img src="{{asset('assets/images/dlt.svg')}}" alt=""></span>
                            </button>
                          </h2>
                          <div id="collapse3" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body pt-0">
                              <div class="pdf-img">
                                <img src="{{asset('assets/images/pdf-3.jpg')}}" alt="">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="pdf-date">
                        <span>Today, 21 April 2023</span>
                      </div>
                      <!-- Editor js -->
                      <div class="ce-example">
                        <div class="ce-example__content _ce-example__content--small">
                          <div id="editorjs-one"></div>
                        </div>
                        <div class="ce-example__output">
                          <pre class="ce-example__output-content" id="output"></pre>
                        </div>
                      </div>
                      <!-- 2 -->
                      <!-- Accordion -->
                      <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
                              Over The Course
                              <span><img src="{{asset('assets/images/dlt.svg')}}" alt=""></span>
                            </button>
                          </h2>
                          <div id="collapse2" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body pt-0">
                              <div class="ce-example">
                                <div class="ce-example__content _ce-example__content--small">
                                  <div id="editorjs-two"></div>
                                </div>
                                <div class="ce-example__output">
                                  <pre class="ce-example__output-content" id="output2"></pre>
                                </div>
                              </div>
                              <span class="d-block text-end color-light text-sm-12 title-font">12:12 pm </span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- 3 -->
                      <div class="ce-example">
                        <div class="ce-example__content _ce-example__content--small">
                          <div id="editorjs-three"></div>
                        </div>
                        <div class="ce-example__output">
                          <pre class="ce-example__output-content" id="output"></pre>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Coches -->
            </div>
            <div class="d-flex align-items-center justify-content-center gap-2 mt-4">
              <a href="javascript:void(0)" class="flip-button" onclick="prevPage()">
                <img src="{{asset('assets/images/prev.svg')}}" alt="" class="in-svg">
              </a>
              <span>01/05</span>
              <a href="javascript:void(0)" class="flip-button" onclick="nextPage()">
                <img src="{{asset('assets/images/back.svg')}}" alt="" class="in-svg">
              </a>
            </div>
            <div class="lm_coches d-flex align-items-center gap-2">
              <h5 class="fw-bold mb-0">Coaches</h5>
              <div class="d-flex align-items-center gap-3 flex-wrap">
                <div class="lm_coches-con">
                  <div class="d-flex justify-content-between align-items-center gap-2">
                    <span class="avtar-45">
                      <img src="{{asset('assets/images/ev1.jpg')}}" alt="">
                    </span>
                    <p class="mb-0 me-4 text-dark">Arlene McCoy</p>
                    <a href="#" class="btn btn--primary btn-sm">Chat</a>
                  </div>
                </div>
                <div class="lm_coches-con">
                  <div class="d-flex justify-content-between align-items-center gap-2">
                    <span class="avtar-45">
                      <img src="{{asset('assets/images/ev2.jpg')}}" alt="">
                      <span class="avtar-active"></span>
                    </span>
                    <p class="mb-0 me-4 text-dark">Albert Flores</p>
                    <a href="#" class="btn btn--primary btn-sm">Chat</a>
                  </div>
                </div>
                <div class="lm_coches-con">
                  <div class="d-flex justify-content-between align-items-center gap-2">
                    <span class="avtar-45">
                      <img src="{{asset('assets/images/ev3.jpg')}}" alt="">
                    </span>
                    <p class="mb-0 me-4 text-dark">Savannah Nguyen</p>
                    <a href="#" class="btn btn--primary btn-sm">Chat</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- <div id="sketchpad" style="background-image: url('assets/images/audit.jpg'); background-repeat: no-repeat;"></div> -->

    </section>
    <div class="lm__modal-overlay">
      <div class="lm__modal">
        <p class="mb-2 h4 text-black">Are you sure you want to remove this note?</p>
        <div class="lm__modal-buttons">
          <a href="#" class="lm__modal-cancel p-1 mr-1 text-danger">Cancel</a>
          <a href="#" class="lm__modal-confirm p-1 text-primary">Confirm</a>
        </div>
      </div>
    </div>
  </main>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"> </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://carstenschaefer.github.io/DrawerJs/dist/drawerJs.standalone.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/turn.js/3/turn.min.js"></script>
<script src="{{ asset('assets/js/main.js') }}"> </script>
<script>
  let book = null;

  function initializeBook() {
    book = $(".lm__book").turn({
      page: 2,
      duration: 900,
      height: $(".lm_pdf-left").height() // Set the height of pages to match the .lm__page height
    });
  }

  function prevPage() {
    if (book !== null) {
      book.turn('previous');
    }
  }

  function nextPage() {
    if (book !== null) {
      book.turn('next');
    }
  }

  // Initialize book on page load
  $(document).ready(function () {
    initializeBook();
    $('.lm__listchecked').on('click', function(e) {
      $(this).toggleClass("active"); //you can list several class names 
      e.preventDefault();
    });
  });

  // Reinitialize book when window is resized
  $(window).resize(function () {
    if (book !== null) {
      book.turn('destroy');
      $(window).unbind('keydown'); // Destroy the existing book instance
    }
    initializeBook();
    console.log("flip eeenter");
  });
</script>

<script>
  let noteId = 0;
  
  document.addEventListener('DOMContentLoaded', () => {
    const leftDiv = document.querySelector('.lm_pdf-left');
    const rightDiv = document.querySelector('.lm_pdf-right');
    const pdfPaddDiv = document.querySelector('.pdf-padd');
    // Modal elements
    const modalOverlay = document.querySelector('.lm__modal-overlay');
    const modalCancel = document.querySelector('.lm__modal-cancel');
    const modalConfirm = document.querySelector('.lm__modal-confirm');
    let noteToDelete;
  
    // Function to show the modal dialog
    function showModal(noteDiv) {
      noteToDelete = noteDiv;
      modalOverlay.style.display = 'block';
    }
  
    // Function to hide the modal dialog
    function hideModal() {
      noteToDelete = null;
      modalOverlay.style.display = 'none';
    }
  
    modalCancel.addEventListener('click', () => {
      hideModal();
    });
  
    modalConfirm.addEventListener('click', () => {
      if (noteToDelete) {
        // Get the selected text of the note being deleted
        const selectedText = noteToDelete.querySelector('h2').textContent;
  
        // Remove the anchor-text span
        const anchorTags = leftDiv.querySelectorAll('.anchor-text');
        anchorTags.forEach(anchorTag => {
          if (anchorTag.textContent === selectedText) {
            anchorTag.parentNode.replaceChild(document.createTextNode(selectedText), anchorTag);
          }
        });
  
        noteToDelete.remove();
        hideModal();
      }
    });
  
    leftDiv.addEventListener('mouseup', () => {
      const selection = window.getSelection();
      if (leftDiv.contains(selection.anchorNode) && leftDiv.contains(selection.focusNode)) {
        if (!selection.isCollapsed) {
          const range = selection.getRangeAt(0);
          const selectedText = range.toString();
  
          if (selectedText.trim() !== "") { // Check if selected text is not empty after trimming spaces
            const noteButton = document.createElement('button');
            noteButton.textContent = 'Add Note';
            noteButton.classList.add('add-note-button');
  
            noteButton.addEventListener('click', () => {
              const noteDiv = document.createElement('div');
              noteDiv.classList.add('note');
              noteId++;
              const noteIdText = `note-${noteId}`;
              noteDiv.id = noteIdText;
  
              const noteHeading = document.createElement('h2');
              noteHeading.textContent = selectedText;
              noteHeading.addEventListener('click', () => {
                const noteContentDiv = noteDiv.querySelector('.note-content');
                noteContentDiv.style.display = noteContentDiv.style.display === 'none' ? 'block' : 'none';
                noteContentDiv.style.maxHeight = noteContentDiv.style.display === 'none' ? 0 : `${noteContentDiv.scrollHeight}px`;
              });
  
              const noteContentDiv = document.createElement('div');
              noteContentDiv.classList.add('note-content');
  
              const noteTextArea = document.createElement('textarea');
              noteTextArea.style.display = 'block';
  
              noteTextArea.addEventListener('input', () => {
                noteTextArea.style.height = 'auto';
                noteTextArea.style.height = `${noteTextArea.scrollHeight}px`;
              });
  
              const deleteButton = document.createElement('button');
              deleteButton.textContent = '';
              deleteButton.classList.add('delete-button');
              deleteButton.addEventListener('click', () => {
                showModal(noteDiv);
              });
  
              const currentTimeSpan = document.createElement('span');
              currentTimeSpan.textContent = getCurrentTime();
  
              noteContentDiv.appendChild(noteTextArea);
              noteContentDiv.appendChild(deleteButton);
              noteContentDiv.appendChild(currentTimeSpan);
  
              noteDiv.appendChild(noteHeading);
              noteDiv.appendChild(noteContentDiv);
              pdfPaddDiv.appendChild(noteDiv);
  
              // Remove the "Add Note" button after creating the note
              noteButton.remove();
  
              // Highlight the selected text in the left div
              const spanWrapper = document.createElement('a');
              spanWrapper.classList.add('highlight');
              spanWrapper.classList.add('anchor-text');
              spanWrapper.href = `#${noteIdText}`;
              spanWrapper.textContent = selectedText;
  
              // Insert the span element into the range
              range.deleteContents();
              range.insertNode(spanWrapper);
  
              selection.removeAllRanges();
            });
  
            const wrapper = document.createElement('span');
            wrapper.appendChild(range.extractContents());
            wrapper.appendChild(noteButton);
            range.insertNode(wrapper);
  
            selection.removeAllRanges();
          }
        }
      }
    });
  
    rightDiv.addEventListener('click', (event) => {
      // Clear previous selections and remove any existing highlighted elements
      const highlightedElements = leftDiv.querySelectorAll('.highlight');
      highlightedElements.forEach(el => {
        el.classList.remove('highlight');
        el.classList.remove('active');
      });
  
      const notes = pdfPaddDiv.querySelectorAll('.note');
      notes.forEach(note => note.classList.remove('active'));
    });
  
    // Function to get the current time in hh:mm format
    function getCurrentTime() {
      const now = new Date();
      const hours = String(now.getHours()).padStart(2, '0');
      const minutes = String(now.getMinutes()).padStart(2, '0');
      return `${hours}:${minutes}`;
    }
  });
</script>

</html>