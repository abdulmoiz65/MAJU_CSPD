import { Route, Routes, Navigate } from "react-router-dom";
import Layout from "./layout/Layout.jsx";
import Home from "./pages/Home.jsx";
import About from "./pages/About.jsx";
import Message from "./pages/Message.jsx";
import Contact from "./pages/Contact.jsx";
import CancelPolicy from "./pages/CancelPolicy.jsx";
import Programs from "./pages/Programs.jsx";
import ProgramDetail from "./pages/ProgramDetail.jsx";
import Navttc from "./pages/Navttc.jsx";
import AboutMaju from "./pages/AboutMaju.jsx";
import Director from "./pages/Director.jsx";
import CompletedPrograms from "./pages/CompletedPrograms.jsx";

function App() {
  return (
    <Routes>
      <Route path='/' element={<Layout />}>
        <Route index element={<Home />} />
        <Route path='about' element={<About />} />
        <Route path='president_message' element={<Message />} />
        <Route path='contact' element={<Contact />} />
        <Route path='cancellation_policy' element={<CancelPolicy />} />
        <Route path='upcoming_programs' element={<Programs />} />
        <Route path='program-detail/:id' element={<ProgramDetail />} />
        <Route path='Navttc' element={<Navttc />} />
        <Route path='about_maju' element={<AboutMaju />} />
        <Route path='director_message' element={<Director />} />
        <Route path='completed_programs' element={<CompletedPrograms />} />
        <Route path='*' element={<Navigate to="/" replace />} />
      </Route>
    </Routes>
  );
}
export default App;