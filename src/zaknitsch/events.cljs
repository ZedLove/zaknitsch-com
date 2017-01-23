(ns zaknitsch.events
  (:require
   [re-frame.core :as rf]
   [zaknitsch.db :as db]))

(rf/reg-event-db
 :initialize-db
 (fn  [_ _]
   db/default-db))
