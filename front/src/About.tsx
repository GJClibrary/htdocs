import Nav from './Nav'; // Import the Nav component

const About = () => (
    <>
    <h1 className="text-4xl font-bold text-center mt-8">About Page</h1>
      {/* Use the Nav component for navigation */}
      <Nav />
      
    <div className='flex flex-col items-center justify-center mt-6'>
      <div className="max-w-prose">
        <p className="text-lg leading-relaxed">
            This website presents the catalogue of books available at the GJC Library. 
        </p>
        <p className="text-lg leading-relaxed mt-5">
            Here, you may 'time-in' or 'time-out' your library attendance, and plan (in advance) to 'take-out' any book that you need to borrow.
        </p>

        <p className="text-lg leading-relaxed mt-5">
            You may also post your own reviews of the books you've read, and engage in dialogue with fellow readers.
        </p>
        </div>
    </div>
    </>
);

export default About;
