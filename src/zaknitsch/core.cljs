(ns zaknitsch.core
  (:require
   [reagent.core :as reagent]
   [re-frisk.core :as re-frisk]
   [re-frame.core :as rf :refer [dispatch dispatch-sync]]
   [devtools.core :as devtools]))


;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;
;; Vars

(defonce debug?
  ^boolean js/goog.DEBUG)

(defonce app-state
  (reagent/atom
   {:text "Hello, what is your name? "}))


;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;
;; Initialize App

(defn dev-setup []
  (when debug?
    (enable-console-print!)
    (re-frisk/enable-frisk!)
    (re-frisk/add-data :app-state app-state)
    (println "dev mode")
    (devtools/install!)
    ))


;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;
;; Entry Point

(defn ^:export main
  []
  (dev-setup)

  (dispatch-sync [:initialise-db])

  (reagent/render []
    (.getElementById js/document "app")))
