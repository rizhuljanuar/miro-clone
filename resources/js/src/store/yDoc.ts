import { defineStore } from "pinia";
import * as Y from "yjs";
import { IMiniTextEditor } from "../pages/admin/actions/project-board/editor/miniTextEditorTypes";
import { IStickyNote } from "../pages/admin/actions/project-board/stickynote/stickyNoteTypes";
import { ITextCaption } from "../pages/admin/actions/project-board/text-caption/textCaptionTypes";
import { userResponseType } from "../pages/auth/actions/tokenTypes";

export interface ICursor {
  cursorPosition: number;
  x: string;
  y: string;
}

export interface IReplayDrawing {
  x: number;
  y: number;
  type: "start" | "drawing";
  strokeStyle: string;
}

const useYDocStore = defineStore("y-doc", {
  state: () => ({
    doc: new Y.Doc(),
    miniTextEditor: [] as IMiniTextEditor[],
    yArrayMiniTextEditor: new Y.Array<IMiniTextEditor>(),

    mousePosition: {
      userName:'',
      x: 0,
      y: 0,
    },
    yMouse: new Y.Map(),

    yCursor: new Y.Map(),
    cursor: {
      typingUser:'',
      cursorPosition: 0,
      x: "",
      y: "",
    },

    yArrayDrawing: new Y.Array<Array<IReplayDrawing>>(),
    arrayDrawing: [] as Array<Array<IReplayDrawing>>,
    //we use it as history
    redoDrawingArray: [] as Array<Array<IReplayDrawing>>,

    loading: false,

    stickyNote:[] as IStickyNote[],
    yArrayStickyNote: new Y.Array<IStickyNote>(),

    yArrayTextCaption:new Y.Array<ITextCaption>(),
    textCaption:[] as ITextCaption[],

    joinees:[] as Array<userResponseType>

  }),
});

export const yDocStore = useYDocStore();
