import { Link } from 'react-router-dom';

const Nav = () => {
  return (
    <div className='flex flex-col items-center justify-center'>
        <div className='underline text-blue-500'>
            <Link to="/">Homepage</Link>
        </div>
        <div className='underline text-blue-500'>
            <Link to="/about">About</Link>
        </div>
        <div className='underline text-blue-500'>
            <Link to="/team">Team</Link>
        </div>
    </div>
  );
};

export default Nav;
