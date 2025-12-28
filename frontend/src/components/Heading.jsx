import './Heading.css';

function Heading(heading_props){
  return (
    <section className='HeadingSection py-4 py-md-5'>
      <div className="HeadingContainer">
        <div className="HeadingHeader">
          <h1>{heading_props.title}</h1>
          <div className="underline"></div>
        </div>
        <p className="HeadingIntro mb-0">
            {heading_props.description}
        </p>
      </div>
    </section>
  );
};

export default Heading;