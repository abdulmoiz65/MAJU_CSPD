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
              <li key={school.id} className="list-group-item py-3 d-flex align-items-center gap-3">
                <span style={{ width: 10, height: 10, borderRadius: '50%', backgroundColor: '#112269', flexShrink: 0 }}></span>
                <Link
                  to={`/summer-school-detail/${school.id}`}
                  className="text-decoration-none fw-semibold fs-5"
                >
                  {school.title}
                </Link>
              </li>
            ))}
          </ul>
        )}
      </div>
    </>
  );
};

export default SummerSchool;
