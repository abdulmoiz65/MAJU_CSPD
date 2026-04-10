import { useEffect, useState } from "react";
import { Link } from "react-router-dom";
import Heading from "../components/Heading";
import diplomaProgramService from "../services/api/diplomaProgramService";

const DiplomaPrograms = () => {
  const [programs, setPrograms] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const fetchPrograms = async () => {
      try {
        const response = await diplomaProgramService.getAllPrograms();
        if (response.success) {
          setPrograms(response.data);
        }
      } catch (error) {
        console.error("Error fetching diploma programs:", error);
      } finally {
        setLoading(false);
      }
    };
    fetchPrograms();
  }, []);

  return (
    <>
      <Heading title="Diploma Programs" />
      <div className="container my-5">
        {loading ? (
          <div className="text-center py-5">
            <p>Loading programs...</p>
          </div>
        ) : programs.length === 0 ? (
          <div className="text-center py-5">
            <p>No diploma programs available at the moment.</p>
          </div>
        ) : (
          <ul className="list-group list-group-flush">
            {programs.map((program) => (
              <li key={program.id} className="list-group-item py-3 d-flex align-items-center gap-3">
                <span style={{ width: 10, height: 10, borderRadius: '50%', backgroundColor: '#112269', flexShrink: 0 }}></span>
                <Link
                  to={`/diploma-program-detail/${program.id}`}
                  className="text-decoration-none fw-semibold fs-5"
                >
                  {program.title}
                </Link>
              </li>
            ))}
          </ul>
        )}
      </div>
    </>
  );
};

export default DiplomaPrograms;
