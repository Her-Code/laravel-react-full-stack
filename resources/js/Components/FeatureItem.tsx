import { Feature } from "@/types";
import { useState } from "react";
import FeatureActionDropdown from "./FeatureActionDropdown";
import FeatureUpvoteDownvote from "./FeatureUpvoteDownvote";

export default function FeatureItem({feature}: {feature:Feature}) {

    const [isExpanded,setIsExpanded] = useState(false);

    const toggleReadMore = () => {
      setIsExpanded(!isExpanded);
    }

    return(
        <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
         <div className="p-6 text-gray-900 dark:text-gray-100 flex gap-8">
             <FeatureUpvoteDownvote feature={feature}/>
            <div className="flex-1">
              <h2 className="text-2xl mb-2">

                {/* <link href={route('feature.show',feature)}>

                  {feature.name}

                </link> */}
                 {/* Use <a> instead of <link> */}
                 <a href={route('feature.show', feature)}>{feature.name}</a>

              </h2>
              {(feature.description || '').length >200 && (
                <>
                  <p>{isExpanded ? feature.description: `${(feature.description || '').slice(0,200)}...`}</p>
                  
                  <button onClick={toggleReadMore} className="text-amber-500 hover:underline">
                    {isExpanded ? 'Read Less':'Read More'}
                  </button>

                </>
              
              )}
              {(feature.description || '').length <= 200 && (

                <p>{feature.description}</p>
              )}
              
             </div>
             <div>
              <FeatureActionDropdown feature={feature}/>
             </div>
        </div>
    </div>

    );

}