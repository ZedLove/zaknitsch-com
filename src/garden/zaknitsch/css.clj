(ns zaknitsch.css
  (:require [garden.def :refer [defstyles]]))

(defstyles screen
  [:body {:background-color "#041e42"
          :color "#ffffff"
          :font-family "sans-serif"}]
  [:p {:border "1px solid #003da5"}])
