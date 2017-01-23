(ns zaknitsch.views
  (:require [re-frame.core :as rf]))

(defn root []
  (let [name (rf/subscribe [:name])]
    [:div "Hello from " @name]))

