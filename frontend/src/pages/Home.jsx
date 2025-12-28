import Slider from "../components/Slider"
import Stats from "../components/Stats"
import UpcomingPrograms from "../components/UP_Cards"
import AboutCombined from "../components/AboutCombined"

function Home(){
    return(
        <>
            <Slider />
            <UpcomingPrograms />
            <Stats  />
            <AboutCombined />
        </>
    )
}

export default Home