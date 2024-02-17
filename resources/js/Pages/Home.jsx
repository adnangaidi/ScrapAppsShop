import { useState } from "react";
import Header from "../Components/Shared/Header.jsx";
import Footer from "../Components/Shared/Footer.jsx";
import Main from "../Components/ComponentHome/Main.jsx";
import Banner from "../Components/ComponentHome/Banner.jsx";
import SearchPage from "./SearchPage";

function Welcome({apps}) {
  const [searchResult, setSearchResult] = useState('');

  const handleSearchResult = (result) => {
    setSearchResult(result);
  };

  return (
    <>
      <Header onSearchResult={handleSearchResult} />
      {
        searchResult === '' ? (
          <>
            <Banner />
            <Main apps={apps}  />
          </>
        ) : (
          <SearchPage result={searchResult} apps={apps}/>
        )
      }
      <Footer />
    </>
  );
}

export default Welcome;
