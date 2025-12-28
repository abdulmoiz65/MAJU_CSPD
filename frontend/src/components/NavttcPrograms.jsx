import { useEffect, useState } from "react";
import { Search, Loader } from "lucide-react";
import navttcProgramService from "../services/api/navttcProgramService";
import "./NavttcProgram.css";

const NavttcPrograms = () => {
  const [programs, setPrograms] = useState([]);
  const [filteredPrograms, setFilteredPrograms] = useState([]);
  const [searchText, setSearchText] = useState("");
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  // Fetch programs on component mount
  useEffect(() => {
    fetchPrograms();
  }, []);

  // Fetch programs from API
  const fetchPrograms = async () => {
    try {
      setLoading(true);
      setError(null);
      const data = await navttcProgramService.getAllPrograms();
      
      // Handle both direct array response and paginated response
      const programsList = Array.isArray(data) ? data : data.data || [];
      setPrograms(programsList);
      setFilteredPrograms(programsList);
    } catch (err) {
      console.error('Failed to fetch programs:', err);
      const errorMessage = err.response?.data?.message || 
                          err.message || 
                          'Failed to load programs. Please try again later.';
      setError(errorMessage);
      setPrograms([]);
      setFilteredPrograms([]);
    } finally {
      setLoading(false);
    }
  };

  // Debounce search method
  useEffect(() => {
    const timer = setTimeout(() => {
      const query = searchText.toLowerCase().trim();

      if (!query) {
        setFilteredPrograms(programs);
        return;
      }

      const filtered = programs.filter(
        (program) =>
          program.title.toLowerCase().includes(query) ||
          program.required_qualification.toLowerCase().includes(query)
      );

      setFilteredPrograms(filtered);
    }, 400); // debounce delay

    return () => clearTimeout(timer);
  }, [searchText, programs]);

  return (
    <section className="trades-section container my-5">
      {/* SEARCH BAR */}
      <div className="trades-search mb-3">
        <Search size={16} />
        <input
          type="text"
          placeholder="Search trade or qualification"
          value={searchText}
          onChange={(e) => setSearchText(e.target.value)}
          disabled={loading}
        />
      </div>

      {/* ERROR MESSAGE */}
      {error && (
        <div className="alert alert-danger alert-dismissible fade show" role="alert">
          {error}
          <button type="button" className="btn-close" onClick={() => setError(null)}></button>
        </div>
      )}

      {/* LOADING STATE */}
      {loading && (
        <div className="text-center py-5">
          <Loader size={32} className="spinner-border" />
          <p className="mt-3">Loading programs...</p>
        </div>
      )}

      {/* TABLE */}
      {!loading && (
        <div className="table-responsive">
          <table className="table trades-table">
            <thead>
              <tr>
                <th>S.#</th>
                <th>Apply for New Trade</th>
                <th>Required Qualification</th>
                <th className="text-end">Registration</th>
              </tr>
            </thead>

            <tbody>
              {filteredPrograms.length ? (
                filteredPrograms.map((program, index) => (
                  <tr key={program.id}>
                    <td>{index + 1}</td>
                    <td>{program.title}</td>
                    <td>{program.required_qualification}</td>
                    <td className="text-end">
                      <a
                        href={program.apply_link || "https://nsis.navttc.gov.pk/"}
                        target="_blank"
                        rel="noopener noreferrer"
                        className="btn btn-sm btn-apply"
                      >
                        Apply Now
                      </a>
                    </td>
                  </tr>
                ))
              ) : (
                <tr>
                  <td colSpan="4" className="text-center py-4">
                    No matching trades found.
                  </td>
                </tr>
              )}
            </tbody>
          </table>
        </div>
      )}
    </section>
  );
};

export default NavttcPrograms;
