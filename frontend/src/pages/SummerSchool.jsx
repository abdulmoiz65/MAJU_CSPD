import { useEffect, useState } from "react";
import { Link } from "react-router-dom";
import Heading from "../components/Heading";
import summerSchoolService from "../services/api/summerSchoolService";

const SummerSchool = () => {
  const [schools, setSchools] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const fetchSchools = async () => {
      try {
        const response = await summerSchoolService.getAllSchools();
        if (response.success) {
          setSchools(response.data);
        }
      } catch (error) {
        console.error("Error fetching summer schools:", error);
      } finally {
        setLoading(false);
      }
    };
    fetchSchools();
  }, []);

  return (
    <>
      <Heading title="Summer School" />
      <div className="container my-5">
        {loading ? (
          <div className="text-center py-5">
            <p>Loading summer schools...</p>
          </div>
        ) : schools.length === 0 ? (
          <div className="text-center py-5">
            <p>No summer school programs available at the moment.</p>
          </div>
        ) : (
          <ul className="list-group list-group-flush">
            {schools.map((school) => (
              <li key={school.id} className="list-group-item py-3">
                <div className="d-flex align-items-start gap-3">
                  <span style={{ width: 10, height: 10, borderRadius: '50%', backgroundColor: '#112269', flexShrink: 0, marginTop: 8 }}></span>
                  <div className="flex-grow-1">
                    <Link
                      to={`/summer-school-detail/${school.id}`}
                      className="text-decoration-none fw-semibold fs-5"
                    >
                      {school.title}
                    </Link>
                    <div className="d-flex flex-wrap gap-3 mt-1">
                      {school.duration && (
                        <span className="text-muted small">
                          <i className="bi bi-clock me-1"></i>
                          {school.duration}
                        </span>
                      )}
                      {school.formatted_fees && (
                        <span className="text-muted small">
                          <i className="bi bi-tag me-1"></i>
                          {school.formatted_fees}
                        </span>
                      )}
                    </div>
                  </div>
                </div>
              </li>
            ))}
          </ul>
        )}
      </div>
    </>
  );
};

export default SummerSchool;
