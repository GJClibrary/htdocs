import Nav from './Nav'; // Import the Nav component
import { DemoTeamMembers } from './components/team-members';

const Team = () => (
  <>
    <h1 className="text-4xl font-bold text-center mt-8">Team Page</h1>
    <Nav />
    <div className='mt-6'>
  <DemoTeamMembers />
  </div>
  </>
);

export default Team;
