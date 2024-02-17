import React, { useState, useEffect } from 'react';
import PrimaryButton from '../Shared/PrimaryButton.jsx';

export default function Buttons({ apps, appsCategory, filterApps, setApps, sendValueButton }) {
  const [value, setValue] = useState('');

  useEffect(() => {
    sendValueButton(value);
    console.log(value);
  }, [value, sendValueButton]);

  const ButtonAll = () => {
    setApps(apps);
    setValue('all');
  };

  const ButtonCategory = (cat) => {
    filterApps(cat);
    setValue(cat);
  };

  return (
    <div>
      <div></div>
      <div className="flex justify-between items-center text-center my-5 mx-10 px-5 ">
        <PrimaryButton children={'All'} onClick={() => ButtonAll()} />

        {appsCategory.map((cat, index) => (
          <PrimaryButton
            key={index}
            onClick={() => ButtonCategory(cat)}
            children={cat}
            className={'m-3 text-sm bg-gray-500 '}
            disabled={false}
          />
        ))}
      </div>
    </div>
  );
}
