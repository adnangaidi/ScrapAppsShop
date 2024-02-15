import { useState } from "react";
import Header from "../Components/Shared/Header.jsx";
import Footer from "../Components/Shared/Footer.jsx";
import Main from "../Components/ComponentDefault/Main.jsx";
import Banner from "../Components/ComponentDefault/Banner.jsx";
import SearchPage from "./SearchPage";
// import apps from "../data.jsx";
//{ auth, apps, categories }
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
