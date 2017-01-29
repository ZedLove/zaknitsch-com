(ns zaknitsch.views
  (:require [re-frame.core :as rf]))

(defn root []
  (let [name (rf/subscribe [:name])
        _ (rf/subscribe [:initialize-db])]
    [:div
     [:p "Hello DICKS from " @name]
     [:p "Other P"]])

  )
