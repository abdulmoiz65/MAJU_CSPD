  import "./Policy.css";

// replace with your actual image
import policyImg from "../assets/policy.png";

const Policy = () => {
  return (
    <section className="policy-section container my-5">
      <div className="row align-items-start">
        {/* LEFT CONTENT */}
        <div className="col-lg-7">
        
          {/* Participant Cancellations */}
          <div className="policy-block">
            <h4>Participant Cancellations</h4>
            <p>
              In the event of a participant’s cancellation, the following policy
              will apply:
            </p>

            <ul>
              <li>
                <strong>5 days before</strong> the start of the workshop: No
                cancellation fee will be charged.
              </li>
              <li>
                <strong>Within 4 to 2 days</strong> prior to the workshop: 50% of
                the program fee will be forfeited.
              </li>
              <li>
                <strong>Within 1 day</strong> of the workshop or No Shows: 100% of
                the program fee will be forfeited.
              </li>
            </ul>

            <p className="policy-note">
              All cancellation requests must be submitted in writing to the
              Center for Skills and Professional Development (CSPD).
            </p>
          </div>


        </div>

        {/* RIGHT IMAGE */}
        <div className="col-lg-5 mt-4 mt-lg-0 text-center order-first order-lg-last">
          <div className="policy-image-wrapper">
            <img
              src={policyImg}
              alt="CSPD Policy"
              className="img-fluid policy-image"
            />
          </div>
        </div>
      </div>
      
        <div className="row align-items-start">
          {/* Postponement */}
          <div className="col-lg-12">
          <div className="policy-block  ">
            <h4>Postponement by CSPD – MAJU</h4>
            <p>
              In case of any unforeseen circumstances, CSPD – MAJU reserves the
              right to postpone the workshop. In such cases, participants may
              either:
            </p>

            <ul>
              <li>Request a full refund, or</li>
              <li>
                Defer their registration to the next available session of the
                same program.
              </li>
            </ul>
          </div>
          </div>

          {/* Substitutions */}
          <div className="col-lg-12">
          <div className="policy-block">
            <h4>Substitutions</h4>
            <p>
              Organizations may nominate a substitute participant up to 2 days
              before the workshop start date. In case an application cannot be
              accommodated, the deposited payment will be returned.
            </p>
          </div>
          </div>

          {/* Deferrals */}
          <div className="col-lg-12">
          <div className="policy-block">
            <h4>Deferrals</h4>
            <p>
              All deferral requests must be made in writing at least 2 days
              before the workshop.
            </p>

            <p>
              Participants may defer their registration to another session of
              the same program within six months. The deposited fee will be
              carried forward.
            </p>

            <p className="policy-note">
              Please note that only one deferral is permitted. After six months,
              the deposited fee will be forfeited.
            </p>
          </div>
          </div>
          </div>



    </section>
  );
};


export default Policy;
