<?php
// Get host and URI
$host = $_SERVER['HTTP_HOST'];
$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$src = '/src';
?>


<?php include("components/main-start.php"); ?>
<?php include("components/head.php"); ?>
<?php include("components/nav.php"); ?>

<div class="container mt-5">
    <h1 class="text-center">About the Library</h1>
    <p class="italic-bold text-center elegant-paragraph">General Objective</p>
    <p class="text-justify ">
    This website presents the catalogue of books available at the GJC Library. 

Here, you may 'time-in' or 'time-out' your library attendance, and plan (in advance) to 'take-out' any book that you need to borrow.

You may also post your own reviews of the books you've read, and engage in dialogue with fellow readers.
    </p>

    <p class="text-justify">
        The chief purpose of GJC Library is to serve the faculty, students, staff, and administrators of GJC in
        their
        academic tasks. To give quality services by providing information and resources that will enhance the
        realization of the vision, mission, and philosophy of the college. The GJC Library recognizes its vital role
        as an indispensable and functional instrument for quality instruction and research. The library aims to
        support instruction provided by the faculty and enriches learning of students in terms of assigned tasks and
        research works. Its organization, facilities, and library resources are geared towards dynamic and quality
        services to its clients.
    </p>

    <h2 class="mt-5">Brief History of GJC Library</h2>
    <p class="text-justify">
        The school, which was founded in 1946, started in a rented building which was the former residence of the
        Moreno family with 6 rooms. One was the Principal’s Office and Teachers’ Room. Adjacent to it were the
        library and laboratory, separated by a thin sawali partition. The library was far from being conducive to
        study because it was used as a classroom. What with the crowded space and the noise of the recitations
        going on, students had no other alternatives but do the studying and reading elsewhere. The other three
        rooms were classrooms. Like the library and laboratory, they were separated from each other by sawali
        partitions that served not even to muffle the voices in each class.
    </p>
    <p class="text-justify">
        After 5 years, the new building of General de Jesus Academy sprawled on A. Vallarta St. in San Isidro, Nueva
        Ecija upon its own lot. The building frontage by a new shingle with the Silver Star, Torch, and Book – our
        pledge to the institution and her trust to us – served as the main features. When formerly the school had
        six rooms, now she has nine (9). Interesting to all are the laboratory and library. In the former is
        gathered costly instruments and chemicals, chart, and specimens – the joy of any eager scientist. The
        library occupying a corner room with windows on both outward sides, literally overflows with maps and
        charts. Sets of encyclopedias, classical and modern literature, magazines, and newspapers – all these, the
        delight of any literary enthusiast the library has. And now, the library is in the true sense of a library.
        It is devoted solely to reading and study.
    </p>
    <p class="text-justify">
        GJC recognizes the vital role of the library in fulfilling the educational requirements of the students;
        hence, it continues to be a part of the online learning community even during the pandemic. With the
        resuming of face-face learning, the library will continue to serve its clientele with a hyflex
        (hybrid-flexible) learning. This is a combination of onsite and offsite access to available library
        resources.
    </p>
</div>


<?php include("components/footer.php"); ?>
<?php include("components/main-end.php"); ?>