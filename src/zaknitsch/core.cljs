(ns zaknitsch.core
  (:require
   [devtools.core :as devtools]
   [reagent.core :as reagent]
   [re-frisk.core :as re-frisk]
   [re-frame.core :as rf :refer [dispatch dispatch-sync]]
   [zaknitsch.config :as config :refer [debug?]]
   [zaknitsch.db :as db]
   [zaknitsch.events :as events]
   [zaknitsch.subs :as subs]
   [zaknitsch.views :as views]))

;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;
;; Initialize App

(defn dev-setup []
  (when debug?
    (enable-console-print!)
    (re-frisk/enable-re-frisk!)
    (println "dev mode")
    (devtools/install!)))


;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;
;; Entry Point

(defn ^:export main
  []
  (dev-setup)
  (rf/clear-subscription-cache!)
  (reagent/render [views/root]
    (.getElementById js/document "app")))
