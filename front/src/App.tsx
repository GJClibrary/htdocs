import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';

import { ThemeProvider } from "@/components/theme-provider";
import About from './About';
import Team from './Team';
import Home from './Home';


const App = () => {
  return (
    <ThemeProvider defaultTheme="dark" storageKey="vite-ui-theme">
      <Router>
        <div className='container mt-5 mb-5 '>
          <Routes>
            <Route path="/" element={<Home />} />
            <Route path="/about" element={<About />} />
            <Route path="/team" element={<Team />} />
          </Routes>
        </div>
      </Router>
    </ThemeProvider>
  );
};

export default App;
